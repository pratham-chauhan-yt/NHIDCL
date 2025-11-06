<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\NhidclTwoFactorVerification;
use App\Services\OtpService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class OtpController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }


    public function sendOtp(Request $request)
    {
        try {
            /* -----------------------------------------------------------
            | 1.  Identify whether user is signing‑up by email or mobile |
            * -----------------------------------------------------------
            */
            if ($request->filled('user_email_id')) {
                $field    = 'email';
                $vrfField = 'email_id';
                $value    = $request->string('user_email_id')->trim();

                // Optional: validate email format
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Invalid email address',
                    ], 409);
                }
            } else {
                $field    = 'mobile';
                $vrfField = 'mobile_no';
                $value    = $request->string('user_mobile')->trim();

                // Validate mobile number length
                if (!preg_match('/^[0-9]{10}$/', $value)) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Mobile number must be 10 digits',
                    ], 409);
                }
            }

            /* -----------------------------------------------------------
            | 2.  Bail if that email / mobile already has an account     |
            * -----------------------------------------------------------
            */
            $moduleName = session('moduleName') ?? 'Resource Pool Portal';
            if (User::where($field, $value)
                    ->where('module_name', $moduleName)
                    ->exists()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => ucfirst($field) . ' already exists in ' . $moduleName,
                ], 409);
            }

            /* -----------------------------------------------------------
            | 3.  Cool‑down: block repeated requests inside 5‑minute     |
            |     window *per* email / mobile.                           |
            * -----------------------------------------------------------
            */
            $maxAttempts      = 5;
            $throttleSeconds  = 600;                                 // 10‑min
            $cooldownSeconds = 300;                                     // 5‑min
            $cacheKey        = 'otp_cooldown:' . $field . ':' . md5($value);
            $verifiedSignUp = NhidclTwoFactorVerification::where($vrfField, $value)->latest()->first();
            // Check if exceeded max attempts
            if (isset($verifiedSignUp) && $verifiedSignUp->valid_otp_count >= $maxAttempts) {
                $unlockTime   = $verifiedSignUp->updated_at->addMinutes(5);
                $current_time = now();

                if ($current_time->lessThan($unlockTime)) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'You have exceeded the invalid OTP limit. Please try again after 5 minutes.'
                    ]);
                }
                // Reset count after lock duration
                $verifiedSignUp->update(['valid_otp_count' => 0]);
            }

            if (Cache::has($cacheKey)) {
                $ttlSeconds = Cache::get($cacheKey) - now()->timestamp;

                if ($verifiedSignUp) {
                    return response()->json([
                        'status'        => 'verify',
                        'message'       => "OTP already sent to your {$field}. Please verify it.",
                        'resend_after'  => $ttlSeconds,
                        'verify_id'     => $verifiedSignUp->id, // this comes from the DB
                    ]);
                }
            }

            /* -----------------------------------------------------------
            | 4.  Throttle: hard‑limit to 5 OTPs in a 10‑minute bucket   |
            * -----------------------------------------------------------
            */
            $throttleKey      = Str::lower("otp|{$field}|{$value}");

            if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                $minutes = ceil($seconds / 60);
                return response()->json([
                    'status'  => 'error',
                    'message' => "You have reached the OTP limit. Try again in {$minutes} minute(s)."
                ], 429);
            }

            /* -----------------------------------------------------------
            | 5.  Generate & send the OTP                               |
            * -----------------------------------------------------------
            */
            $otp = generateOtp();                                       // e.g. 6‑digit helper
            $table = 'REC_OTP_TEMPLATE';
            // Call your service (SMS / Mail) – handle $isSent boolean  
            $isSent = $this->otpService->sendOtp($field, $value, $otp, $table);
            if (! $isSent) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unable to send OTP. Please try again later.',
                ], 500);
            }

            /* -----------------------------------------------------------
            | 6.  Store / update row in nhidcl_two_factor_verification   |
            * -----------------------------------------------------------
            */
            $twoFA = NhidclTwoFactorVerification::where($vrfField, $value)
                    ->where('type', 1)                   // Sign‑up OTP
                    ->whereNull('deleted_at')
                    ->first();

            if ($twoFA) {
                $twoFA->update([
                    'otp'       => Hash::make($otp),
                    'otp_count' => DB::raw('otp_count + 1'),
                    'updated_at'=> now(),
                ]);
            } else {
                NhidclTwoFactorVerification::create([
                    'email_id'  => $field === 'email'  ? $value : null,
                    'mobile_no' => $field === 'mobile' ? $value : null,
                    'type'      => 1,
                    'otp_count' => 1,
                    'otp'       => Hash::make($otp),
                ]);
            }

            /* -----------------------------------------------------------
            | 7.  Commit cooldown + throttle hit                         |
            * -----------------------------------------------------------
            */
            Cache::put($cacheKey, now()->addSeconds($cooldownSeconds)->timestamp, $cooldownSeconds);
            RateLimiter::hit($throttleKey, $throttleSeconds);

            return response()->json([
                'status'  => 'success',
                'message' => "OTP has been sent to your {$field}.",
            ]);
        } catch (\Throwable $e) {

             Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try after some time.',
            ], 500);
        }
    }

    public function verifyOTP(VerifyOtpRequest $request)
    {
        try {
            $request->validated();

            // Identify type (email / mobile)
            if ($request->has("user_email_id")) {
                $field     = "email";
                $vrfField  = "email_id";
                $value     = $request->get("user_email_id");
                $otp       = $request->get("user_email_otp");
            } else {
                $field     = "mobile";
                $vrfField  = "mobile_no";
                $value     = $request->get("user_mobile");
                $otp       = $request->get("user_mobile_otp");
            }

            $otp = base64_decode(urldecode($otp));

            $otpFailedAttemptCount = 5;

            // Fetch latest OTP record
            $data = NhidclTwoFactorVerification::where($vrfField, $value)->latest()->first();

            if (!$data) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'No OTP record found for verification.'
                ]);
            }

            // Check if exceeded max attempts
            if ($data->valid_otp_count >= $otpFailedAttemptCount) {
                $unlockTime   = $data->updated_at->addMinutes(5);
                $current_time = now();

                if ($current_time->lessThan($unlockTime)) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'You have exceeded invalid OTP limit. Please try again after 5 minutes.'
                    ]);
                }
                // Reset count after lock duration
                $data->update(['valid_otp_count' => 0]);
            }

            // Verify OTP
            if (Hash::check($otp, $data->otp)) {
                $record = NhidclTwoFactorVerification::where('verify_status', 0)
                    ->where($vrfField, $value)
                    ->latest()
                    ->first();

                if ($record) {
                    $record->update([
                        'verify_status' => 1,
                        'deleted_at'    => now()
                    ]);
                }

                return response()->json([
                    'status'  => 'success',
                    'message' => "OTP verified successfully"
                ]);
            }

            // Invalid OTP case
            $valid_otp_count = $data->valid_otp_count + 1;
            $data->update(['valid_otp_count' => $valid_otp_count]);

            $remainingAttempts = max($otpFailedAttemptCount - $valid_otp_count, 0);

            return response()->json([
                'status'  => 'error',
                'message' => "Invalid OTP. You have {$remainingAttempts} attempts remaining."
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
