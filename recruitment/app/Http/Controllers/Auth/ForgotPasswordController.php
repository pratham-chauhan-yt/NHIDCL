<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Override sendResetLinkEmail to add custom validation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {   
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:ref_users,email',
            //'captcha' => 'required|captcha',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'No such email address registered with us.',
            // 'captcha.required' => 'The captcha field is required.',
            // 'captcha.captcha' => 'Invalid captcha code.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('password.request')
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Rate limiting (prevent abuse)
        $rateLimitKey = $request->input('email') . '|resesssst|' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->route('password.request')
                ->withErrors(['error' => "Too many reset password attempts. Please try again after 24 hours."]);
        }
        
        try {
            $emailid = $request->input('email');

            // Find user by email, but exclude Recruitment Portal
            $user = User::where('email', $emailid)
            ->when(true, function ($q) {
                $q->where(function ($query) {
                    $query->where('module_name', 'Recruitment Portal')
                        ->orWhereNull('module_name');
                });
            })
            ->first();
            $isRecruitmentUser = $user->hasRole(['Recruitment User', 'HR-Recruitment']);
            if (($user && !$isRecruitmentUser)) {
                return redirect()->route('password.request')->withErrors(['error' => 'No user found with this email.']);
            }
            $email = $user->email;
            // 3. Create a secure token
            $token = Str::random(64);

            // 4. Store hashed token in DB
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'email' => $email,
                    'token' => Hash::make($token),
                    'created_at' => now(),
                ]
            );

            // 5. Build reset URL
            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $email,
            ], true));

            try {
                Mail::to($email)->send(new ResetPasswordMail($resetUrl));
            } catch (\Exception $e) {
                Log::error("Email sending failed: " . $e->getMessage());
                Log::error("File: " . $e->getFile() . " Line: " . $e->getLine());
            }
            
            // 7. Hit rate limiter
            RateLimiter::hit($rateLimitKey, 1200);

            Alert::success(
                'Success!',
                'You’ll receive a password reset link shortly. Be sure to check your spam or junk folder too.'
            );

            return redirect()->route('auth.login')->with('success', 'You’ll receive a password reset link shortly.');

        } catch (\Exception $e) {
            Log::error('ForgetController@error: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while processing your request.');
            return redirect()->route('password.request')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }



}
