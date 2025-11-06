<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Use statements come after the namespace
use App\Http\Controllers\UserActivityController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\NhidclTwoFactorVerification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Services\OtpService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use App\Mail\ResetPasswordMail;
use App\Http\Requests\CandidateRegstrationRequest;
use App\Mail\NewUserSetPasswordMail;
use App\Models\NhidclUserStatus;

class RecruitmentLoginController extends Controller
{   
    use AuthenticatesUsers, SendsPasswordResetEmails {
        AuthenticatesUsers::credentials insteadof SendsPasswordResetEmails;
        SendsPasswordResetEmails::credentials as passwordResetCredentials;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/recruitment-portal/dashboard';

    /**
     * Override the username method to return "login" for user ID or email
     *
     * @return string
     */
    public function username()
    {
        return 'login'; // This should match the input name in the form
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $otpService;
    
    public function  __construct(OtpService $otpService)
    {   
        $this->otpService = $otpService;
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function recruitmentLogin(){
        $header = TRUE;
        $sidebar = TRUE;
        session(['moduleName' => "Recruitment Portal"]);
        session(['moduleHeading' => ""]);
        return view('auth.recruitment-login', compact('header', 'sidebar'));
    }
    
    public function login(Request $request): Response|RedirectResponse
    {   
        try {
            // 1. Validation
            $validator = Validator::make($request->all(), [
                'login' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $value)) {
                            $fail('The login must be a valid email address.');
                        }
                    }
                ],
                'password' => 'required|string',
                'captcha'  => 'required|captcha',
            ], [
                'login.required'    => 'The login field is required.',
                'password.required' => 'The password field is required.',
                'captcha.required'  => 'The captcha field is required.',
                'captcha.captcha'   => 'Wrong captcha.',
            ]);

            if ($validator->fails()) {
                return redirectBack($request, $validator->errors()->toArray());
            }
            
            // 2. Rate limiting
            $rateLimitKey = $request->input('login') . '|login|' . $request->ip();
            if (RateLimiter::tooManyAttempts($rateLimitKey, 30)) {
                $seconds = RateLimiter::availableIn($rateLimitKey);
                return redirectBack($request, [
                    'error' => "Too many login attempts. Please try again in " . ceil($seconds / 60) . " minutes."
                ]);
            }
            
            // 3. Decrypt password
            $decrypted = decryptPassword($request->input('password'), session('salt'));
            if (!$decrypted) {
                RateLimiter::hit($rateLimitKey, 1200);
                return redirectBack($request, ['error' => 'The email id or password entered is incorrect.']);
            }
            
            // 4. Find user (Recruitment / Resource / Admin)
            $user = null;
            $action = $request->input('action');
            $user = User::where('email', $request->input('login'))
                        ->where('module_name', 'Recruitment Portal')
                        ->first();
            if (!$user) {
                RateLimiter::hit($rateLimitKey, 1200);
                return redirectBack($request, ['login' => 'The email id or password entered is incorrect.']);
            }
            
            // 5. Verify password
            if (Hash::check($decrypted, $user->password)) {
                $request->session()->put('otp_user_id', $user->id);
                $request->session()->put('remember_me', $request->filled('remember'));
                RateLimiter::clear($rateLimitKey);
                return redirect()->route('recruitment.twoFactor.index');
            }

            // 7. Wrong password
            RateLimiter::hit($rateLimitKey, 1200);
            return redirectBack($request, [
                'error' => 'The email id or password entered is incorrect.'
            ]);

        } catch (\Throwable $e) {
            Log::error('Login error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip'    => $request->ip(),
                'login' => $request->input('login'),
            ]);
            return redirectBack($request, [
                'error' => 'Something went wrong while processing your request. Please try again later.'
            ]);
        }
    }

    public function twoFactorIndex(Request $request){
        try {
            session(['moduleName' => "Recruitment Portal"]);
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
                return view('auth.recruitment-twofa', compact('remainingSeconds'));
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
            Alert::success('Success', 'OTP code sent to mobile and email ID.');

            return view('auth.recruitment-twofa', compact('remainingSeconds'));
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
            return redirect()->route('recruitment.twoFactor.index')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $userId = $request->session()->get('otp_user_id');
            $otpKey = 'otp_verify|' . ($userId ?? $request->ip());
            $user = User::find($userId);
            if (!$user) {
                return redirect()->route('recruitment.login')->withErrors(['error' => 'Session expired, please login again.']);
            }
            $otpData = NhidclTwoFactorVerification::where('email_id', $user->email)
                ->where('mobile_no', $user->mobile)
                ->where('type', 2)
                ->whereNull('deleted_at') // Soft delete check
                ->first();
            if (!$otpData) {
                return redirect()->route('recruitment.login')->withErrors(['error' => 'OTP not found or already used']);
            }

            $now = now();
            $lastSentAt = session('otp_last_sent_at');

            // Check OTP expiry (2 minutes)
            if (!$lastSentAt || $now->diffInSeconds($lastSentAt) >= 300) {
                return redirect()->route('recruitment.twoFactor.index')->withErrors([
                    'code' => 'OTP has expired. Please request a new one.'
                ]);
            }
            $enteredCode = $request->input('code');

            if (Hash::check($enteredCode, $otpData->otp)) {
                $remember = $request->session()->pull('remember_me', false);
                
                // Log them in using recruitment guard
                Auth::guard('recruitment')->login($user, $remember);
                session(['recruitment_login' => true]);
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
                return redirect()->intended(route('recruitment-portal.recruitment.dashboard'));
            } else {
                $otpData->increment('valid_otp_count');
                Alert::error('Error', 'The provided two-factor code is incorrect.');
                return redirect()->route('recruitment.twoFactor.index')->withErrors([
                    'code' => 'Entered OTP code is invalid.'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('TwoFactorController@otpVerify error: ' . $e->getMessage());
            return redirect()->route('recruitment.twoFactor.index')->withErrors([
                'code' => 'An unexpected error occurred. Please try again.'
            ]);
        }
    }

    public function showLinkRequestForm()
    {   
        session(['moduleName' => "Recruitment Portal"]);
        return view('auth.passwords.recruitment-email');
    }

    public function sendResetLinkEmail(Request $request)
    {   
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:ref_users,email',
            'captcha' => 'required|captcha',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'No such email address registered with us.',
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'Invalid captcha code.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('recruitment.password.request')
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Rate limiting (prevent abuse)
        $rateLimitKey = $request->input('email') . '|resesssst|' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->route('recruitment.password.request')
                ->withErrors(['error' => "Too many reset password attempts. Please try again after 24 hours."]);
        }

        try {
            $emailid = $request->input('email');

            // Find user by email, but exclude Recruitment Portal
            $user = User::where('email', $emailid)
                        ->where('module_name', 'Recruitment Portal')
                        ->first();
            if (!$user) {
                return redirect()->route('recruitment.password.request')->withErrors(['error' => 'No user found with this email.']);
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
            $resetUrl = url(route('recruitment.password.reset', [
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
                'You`ll receive a password reset link shortly. Be sure to check your spam or junk folder too.'
            );

            return redirect()->route('recruitment.login')->with('success', 'You’ll receive a password reset link shortly.');

        } catch (\Exception $e) {
            Log::error('ForgetController@error: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while processing your request.');
            return redirect()->route('recruitment.password.request')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }

    public function showResetForm(Request $request)
    {   
        session(['moduleName' => "Recruitment Portal"]);
        $token = $request->route()->parameter('token');
        $user = User::where('email', $request->email)->first();
        return view('auth.passwords.recruitment-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {    
        // 1. Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:ref_users,email',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
            'captcha' => 'required|captcha',
        ]);
        
        if ($validator->fails()) {
            $token = $request->input('token');
            $email = $request->input('email');
            $redirectUrl = route('recruitment.password.reset', ['token' => $token]) . '?email=' . urlencode($email);

            return redirect()->to($redirectUrl)
                ->withErrors($validator)
                ->withInput();
        }
        
        $token = $request->input('token');
        $email = $request->input('email');
        $redirectUrl = route('recruitment.password.reset', ['token' => $token]) . '?email=' . urlencode($email);

        // 2. Find the user
        $user = User::where('email', $request->email)
        ->where('module_name', 'Recruitment Portal')->first();
        if (!$user) {
            return redirect()->to($redirectUrl)->withErrors(['email' => 'User not found.']);
        }
        // 3. Verify the token manually (if you have a password_reset_tokens table)
        $reset = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!Hash::check($request->token, $reset->token)) {
            return redirect()->to($redirectUrl)->withErrors(['error' => 'Invalid or expired token.']);
        }
        
        $decrypted = decryptPassword($request->input('password'), session('salt'));
        if (!$decrypted) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->to($redirectUrl)->withErrors(['error' => 'Password encryption failed. Please try again.']);
        }
        
        // 4. Update the password manually
        $user->password = Hash::make($decrypted);
        $user->save();
        
        // 5. Delete the token after successful reset
        Alert::success('Success', 'Your password has been reset successfully.');
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('recruitment.login')->with('success', 'Your password has been reset successfully.');
    }

    public function registration()
    {
        $header = TRUE;
        $sidebar = TRUE;
        $roles = Role::all();
        session(['moduleName' => "Recruitment Portal"]);
        return view('auth.candidate.recruitment-registration', compact('header', 'sidebar'));
    }

    public function store(CandidateRegstrationRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $generatedPassword = Str::random(12);
            if (Auth::check()) {
                return redirect()->route('recruitment.auth.registration')->with('error', 'You are already logged in.');
            }
            $mobileUser = NhidclTwoFactorVerification::where('mobile_no', trim((string)$validatedData['mobile']))
                ->where('verify_status', 1)
                ->withTrashed() // if needed
                ->latest()
                ->first();
            if (!$mobileUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mobile is not verified.',
                    'data' => $mobileUser
                ]);
            }

            $emailUser = NhidclTwoFactorVerification::withTrashed()
                ->where('email_id', $validatedData['email'])
                ->where('verify_status', 1)
                ->whereNotNull('deleted_at') // i.e., OTP was used/verified
                ->latest()
                ->first();

            if (!$emailUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email is not verified.'
                ]);
            }
            $moduleName = session('moduleName') ?? 'Resource Pool Portal';
            $insertData = array(
                'name' => htmlspecialchars($validatedData['name']),
                'email' => htmlspecialchars($validatedData['email']),
                'mobile' => $request->mobile,
                'date_of_birth' => $request->date_of_birth,
                'is_nhidcl_employee' => 0,
                'user_code' => rand() . time(),
                'password' => bcrypt($generatedPassword),
                'module_name' => $moduleName,
                'status' => 'Active',
            );

            // Create the user
            $candidateUser = User::create($insertData);

            if ($candidateUser) {
                $data = new NhidclUserStatus();
                $data->ref_users_id = $candidateUser->id;
                $data->ref_interview_status_id = 1;
                $data->save();
            }
            $roles = match (session('moduleName')) {
                'Recruitment Portal' => ['Recruitment User'],
                default              => ['Resource Pool User'],
            };
            $rolesWithParentIds = collect($roles)->map(function ($roleName) {
                $role = Role::findByName($roleName);
                if ($role && $role->name !== 'Super Admin') {
                    return [
                        'role_id' => $role->id,
                        'parent_role_id' => $role->parent_role_id,
                    ];
                }
                return null;
            })
            ->filter()
            ->values()
            ->toArray();
            $candidateUser->syncRolesWithLogging($rolesWithParentIds);
            // Generate token and Send the reset link to the user's email
            $token = app('auth.password.broker')->createToken($candidateUser);
            try {
                Mail::to($candidateUser->email)->send(new NewUserSetPasswordMail($candidateUser, $token));
            } catch (TransportExceptionInterface $e) {
                Log::error("OTP mail send failed: " . $e->getMessage());
                // Fallback logic: you can still continue if SMS was sent
            }
            
            if ($request->ajax()) {
                $moduleName = session('moduleName') ?? 'Resource Pool Portal';
                $redirectRoute = $moduleName === 'Recruitment Portal'
                    ? route('recruitment.login')   // your recruitment login route
                    : route('recruitment.login');         // your candidate/general login route
                return response()->json([
                    'success' => true,
                    "redirect" => $redirectRoute,
                    'message' => 'Access your email ID for further instructions.!'
                ]);
            } else {
                Alert::success('Success', 'Access your email ID for further instructions.!');
                return redirect()->route('recruitment.auth.registration')->with('success', 'Access your email ID for further instructions.!');
            }
        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('recruitment.auth.registration')->with('error', 'Something went wrong. Please try again later.');
        }
    }


    protected function logout(Request $request)
    {
        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            // Log activity
            (new UserActivityController())->logActivity('User logged out successfully', $user->id);

            // Update user status
            $user->is_logged = 0;
            $user->save();

            // Logout user first
            Auth::logout();

            // Clear session fully
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect based on role
            return redirect()->route('recruitment.login');
        }

        // Fallback if somehow user is not instance of User
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('recruitment.login');
    }
}
