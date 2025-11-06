<?php

namespace App\Http\Controllers\Auth; // This should be the very first line

use App\Http\Controllers\Controller; // Use statements come after the namespace
use App\Http\Controllers\UserActivityController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserActivity;

class TaskManagementLoginController extends Controller
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
    }

    public function getLogin()
    {
        $header = TRUE;
        $sidebar = TRUE;
        return view('auth.taskManagementUser', compact('header', 'sidebar'));
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function loginPost(Request $request)
    {
        // Validate the form input
        $this->validate($request, [
            'login' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $value)) {
                        $fail('The login must be a valid email address or user ID.');
                    }
                }
            ],
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);


        // Attempt to authenticate the user with either email or user ID
        $email = $request->input('login');
        $user = User::where('email', $email)->orWhere('user_id', $email)->first(); // Ensure you are checking user_id, not id

        if ($user && Auth::attempt(['user_id' => $user->user_id, 'password' => $request->password], $request->filled('remember'))) {
            $user->is_logged = 1;
            $user->save();

            // Log::info('This is an informational message.');
            // Log::info('User logged in: ' . $user->user_id); // Log successful login

            (new UserActivityController())->logActivity('User logged in');

            // Authentication passed...

            $roleUser = DB::table('role_user')->where('parent_role_id',3)->where('user_id', $user->id)->first();

            if(!empty($roleUser)){
                return redirect()->route('change-password',Crypt::encrypt(Auth::user()->id));
            }else{
               // return redirect()->intended($this->redirectTo);
            }

        }

        // If authentication fails
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
            'password' => 'The current password is invalid.',
            'captcha' => 'Invalid captcha try again.',
        ]);
    }


    protected function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();

        return redirect('/');
    }
}
