<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NhidclTwoFactorVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserActivityController;
use Illuminate\Support\Facades\DB;
use App\Mail\OtpMail;
use App\Services\OtpService;
use App\Services\Sms\SmsGateway;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TwoFactorController extends Controller
{

    // public $sms;
    // public function  __construct(SmsGateway $sms)
    // {
    //     $this->sms = $sms;
    // }
    public $otpService;
    public function  __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index(Request $request)
    {
        try {
            $user = getUserFromSession($request);
            if (!$user) {
                return expireSession($request, 'Session expired, please login again.');
            }

            $otpKey = 'otp_verify|' . ($user->id ?? $request->ip());
            $cooldownSeconds = 300;
            $throttleLimit   = 3;
            $throttleWindow  = 600;

            // Too many attempts
            if (RateLimiter::tooManyAttempts($otpKey, $throttleLimit)) {
                $minutes = ceil(RateLimiter::availableIn($otpKey) / 60);
                return redirectBack($request, ['error' => "Too many OTP attempts. Try again in {$minutes} minute(s)."]);
            }

            // Cooldown
            $lastSentAt = session('otp_last_sent_at');
            $now = now();
            if ($lastSentAt && $now->diffInSeconds($lastSentAt) < $cooldownSeconds) {
                $remainingSeconds = $cooldownSeconds - $now->diffInSeconds($lastSentAt);
                return view('auth.twoFactorAuth', compact('remainingSeconds'));
            }

            // Generate & persist OTP
            $code = rand(100000, 999999);
            storeOtp($user, $code);

            // Send OTP
            if(!empty($user->email)){
                $this->otpService->sendOtp('email', $user->email, $code, 'OTP_TEMPLATE');
            }
            if (!empty($user->mobile)) {
                $this->otpService->sendOtp('mobile', $user->mobile, $code, 'OTP_TEMPLATE');
            }

            session(['otp_last_sent_at' => $now]);
            RateLimiter::hit($otpKey, $throttleWindow);

            $remainingSeconds = $cooldownSeconds;
            Alert::success('Success', 'OTP code sent to mobile or email ID.');

            return view('auth.twoFactorAuth', compact('remainingSeconds'));
        } catch (\Exception $e) {
            Log::error('TwoFactorController@index error: ' . $e->getMessage());
            return expireSession($request, 'An unexpected error occurred. Please try again.');
        }
    }

    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric|digits:6',
            'captcha' => 'required|captcha',
        ], [
            'code.required' => 'The OTP field is required.',
            'code.numeric' => 'The OTP must be a number.',
            'code.digits' => 'The OTP must be exactly 6 digits.',
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'Invalid captcha code.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('twoFactor.index')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $userId = $request->session()->get('otp_user_id');
            $otpKey = 'otp_verify|' . ($userId ?? $request->ip());
            $user = User::find($userId);
            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'Session expired, please login again.']);
            }
            $otpData = NhidclTwoFactorVerification::where('email_id', $user->email)
                ->where('mobile_no', $user->mobile)
                ->where('type', 2)
                ->whereNull('deleted_at') // Soft delete check
                ->first();
            if (!$otpData) {
                return redirect()->route('login')->withErrors(['error' => 'OTP not found or already used']);
            }

            $now = now();
            $lastSentAt = session('otp_last_sent_at');

            // Check OTP expiry (2 minutes)
            if (!$lastSentAt || $now->diffInSeconds($lastSentAt) >= 300) {
                return redirect()->route('twoFactor.index')->withErrors([
                    'code' => 'OTP has expired. Please request a new one.'
                ]);
            }
            $enteredCode = $request->input('code');

            if (Hash::check($enteredCode, $otpData->otp)) {
                $remember = $request->session()->pull('remember_me', false);

                // Log them in using web guard
                Auth::guard('web')->login($user, $remember);
                
                $user->is_logged = 1;
                $user->last_login_token = Str::random(60); // create a new token per login
                $user->last_login_at = now();
                $user->last_login_ip = $request->ip();
                $user->save();

                session(['LOGIN_TOKEN' => $user->last_login_token]);

                // If OTP is valid, update verify status and soft delete the record
                $otpData->verify_status = 1;
                $otpData->delete();

                $request->session()->forget('otp_user_id');
                $request->session()->put('user_id', $user->id);
                session(['two_factor_verified' => true]);
                session()->forget('otp_last_sent_at');
                (new UserActivityController())->logActivity('User logged in successfully', $user->id);
                RateLimiter::clear($otpKey);
                return redirect()->route('admin.dashboard');
            } else {
                $otpData->increment('valid_otp_count');
                Alert::error('Error', 'Entered OTP code is invalid.');
                return redirect()->route('twoFactor.index')->withErrors([
                    'code' => 'Entered OTP code is invalid.'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('TwoFactorController@otpVerify error: ' . $e->getMessage());
            return redirect()->route('twoFactor.index')->withErrors([
                'code' => 'An unexpected error occurred. Please try again.'
            ]);
        }
    }
}
