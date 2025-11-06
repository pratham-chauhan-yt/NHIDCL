<?php

namespace App\Http\Controllers\Auth; // This should be the very first line

use App\Http\Controllers\Controller; // Use statements come after the namespace
use App\Http\Controllers\UserActivityController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');

        if (Cache::missing('daily_task_generation_ran')) {
            Artisan::call('tasks:generate-recurring');
            Cache::put('daily_task_generation_ran', true, now()->addDay());
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request): Response|RedirectResponse
    {
        try {
            // ---------------------------
            // 1. Validation
            // ---------------------------
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

            // ---------------------------
            // 2. Rate limiting
            // ---------------------------
            $rateLimitKey = $request->input('login') . '|login|' . $request->ip();
            if (RateLimiter::tooManyAttempts($rateLimitKey, 30)) {
                $seconds = RateLimiter::availableIn($rateLimitKey);
                return redirectBack($request, [
                    'error' => "Too many login attempts. Please try again in " . ceil($seconds / 60) . " minutes."
                ]);
            }

            // ---------------------------
            // 3. Decrypt password
            // ---------------------------
            $decrypted = decryptPassword($request->input('password'), session('salt'));
            if (!$decrypted) {
                RateLimiter::hit($rateLimitKey, 1200);
                return redirectBack($request, ['error' => 'The email id or password entered is incorrect.']);
            }
    
            $user = null;
            $user = User::where('email', $request->input('login'))
                ->where('module_name', '!=', 'Recruitment Portal')
                ->first();
            if (!$user) {
                $user = User::where('email', $request->input('login'))
                            ->whereNull('module_name')
                            ->first();
            }
            if (!$user) {
                RateLimiter::hit($rateLimitKey, 1200);
                return redirectBack($request, ['login' => 'The email id or password entered is incorrect.']);
            }
            // ---------------------------
            // 4. Role + action validation
            // ---------------------------
            $isRecruitmentUser = $user->hasRole(['Recruitment User', 'HR-Recruitment']);
            if (($user && $isRecruitmentUser)) {
                (new UserActivityController())->logActivity('The email id or password entered is incorrect.', $user->id);
                return redirectBack($request, ['error' => 'The email id or password entered is incorrect.']);
            }

            // ---------------------------
            // 5. Verify password
            // ---------------------------
            
            if (Hash::check($decrypted, $user->password)) {
                $request->session()->put('otp_user_id', $user->id);
                $request->session()->put('remember_me', $request->filled('remember'));
                RateLimiter::clear($rateLimitKey);
                return redirect()->route('twoFactor.index');
            }

            // ---------------------------
            // 6. Wrong password
            // ---------------------------
            RateLimiter::hit($rateLimitKey, 1200);
            (new UserActivityController())->logActivity('The email id or password entered is incorrect.', $user->id);
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


    protected function logout(Request $request)
    {
        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            // Track if recruitment user before logout
            $isRecruitmentUser = $user->hasRole('Recruitment User');

            // Log activity
            (new UserActivityController())->logActivity('User logged out successfully', $user->id);

            // Update user status
            $user->is_logged = 0;
            $user->save();

            // Logout user first
            Auth::guard('web')->logout();

            // Clear session fully
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect based on role
            return $isRecruitmentUser
                ? redirect()->route('recruitment.login')
                : redirect()->route('auth.login');
        }

        // Fallback if somehow user is not instance of User
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

}
