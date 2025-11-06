<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Traits\HasRoles;
use App\Models\DepartmentMaster;
use Illuminate\Support\Facades\Hash;
use App\Models\Session;
use ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\UserActivity;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index($id)
    {

        // dd($id); die;
        try {
            $user = User::with(['creator', 'updater', 'roles'])->findOrFail(Crypt::decrypt($id));
            $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name', 'asc')->get();
            $department = DepartmentMaster::orderBy('name', 'asc')->get();

            $hasRoles = $user->roles->pluck('id');

            $header = true;
            $sidebar = true;
            return view('profile.index', compact('user', 'roles', 'hasRoles', 'header', 'sidebar', 'department'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later..');
            return redirect()->route('profile', ['id' => $id]);
        }
    }


    public function profile_update(Request $request)
    {

        try {

            $updateData = [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'updated_by' => Auth::user()->id,
            ];

            $user = User::findOrFail($request->id);
            $user->update($updateData);

            Alert::success('Success', 'User updated successfully');
            return redirect()->route('profile.update');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('profile.update');
        }
    }

    public function changePassword($id)
    {

        try {
            $user = User::with(['creator', 'updater', 'roles'])->findOrFail(Crypt::decrypt($id));

            $header = true;
            $sidebar = true;
            return view('profile.change_password', compact('user', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('profile', ['id' => $id]);
        }
    }

    public function candidateChangePassword(Request $request)
    {

        try {
            $id = Auth::user()->id;
            $user = User::with(['creator', 'updater', 'roles'])->findOrFail($id);

            $header = true;
            $sidebar = true;
            return view('profile.change_password', compact('user', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('change-password');
        }
    }


    public function resetBackend(Request $request)
    {    
        $user = User::find($request->u_id);
        if (!$user) {
            Alert::error('Error', 'User not found.');
            return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['error' => 'User not found']);
        }
        $nameParts = explode(' ', strtolower($user->name ?? ''));

        // 🔹 Step 1: Decrypt the incoming password fields using session salt
        $currentPassword = decryptPassword($request->input('current_password'), session('salt'));
        $decryptedPassword = decryptPassword($request->input('password'), session('salt'));
        $decryptedPasswordConfirmation = decryptPassword($request->input('password_confirmation'), session('salt'));

        // Replace request input values with decrypted passwords
        $request->merge([
            'current_password' => $currentPassword,
            'password' => $decryptedPassword,
            'password_confirmation' => $decryptedPasswordConfirmation,
        ]);
        
        // 🔹 Step 2: Validate input (including email, token, captcha, and password rules)
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('email', $request->email)->first();
                    $userName = strtolower(trim($user->name ?? ''));
                    $passwordLower = strtolower($value);

                    if (preg_match('/(012|123|234|345|456|567|678|789|abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz)/i', $value)) {
                        $fail('The '.$attribute.' cannot contain three or more consecutive letters or numbers (e.g., 123, abc).');
                    }

                    $nameParts = array_filter(explode(' ', $userName));
                    foreach ($nameParts as $part) {
                        if (!empty($part) && str_contains($passwordLower, $part)) {
                            $fail('The '.$attribute.' should not include your first or last name.');
                            break;
                        }
                    }
                },
            ],            
            //'captcha' => 'required|captcha',
        ], [
            'password.confirmed' => 'Password and confirmation do not match.',
        ]);

        if ($validator->fails()) {            
            return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors($validator)
                ->withInput();
        }
        
        $rateLimitKey = $request->u_id . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['error' => "Too many reset password attempts. Please try again 24 hours."]);
        }

        try {
            
            if (!$currentPassword) {
                return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['current_password' => 'Invalid current password format.']);
            }
            if (!Hash::check($currentPassword, $user->password)) {
                Alert::error('Error', 'The current password is incorrect.');
                return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if ($request->current_password === $request->password) {
                Alert::error('Error', 'New password cannot be the same as the old password.');
                return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['password' => 'New password cannot be the same as the old password.']);
            }
            
            $user->password = Hash::make($decryptedPassword);
            $user->save();

            // Log the password change
            //Log::info('Password changed successfully for user ID: ' . $user->id);
            (new UserActivityController())->logActivity('User account password change successfully', $user->id);

            
            RateLimiter::hit($rateLimitKey, 1200);
            // Logout other sessions before changing password
            Session::where('user_id', $user->id)->delete();
            Auth::logoutOtherDevices($currentPassword);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('auth.login')->with('success', 'Password changed successfully. Please log in again.');
        } catch (\Exception $e) {
            Log::error('Password change failed for user ID: ' . $request->u_id . ' - ' . $e->getMessage());

            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('change-password', Crypt::encrypt($user->id))->withErrors(['error' => 'Internal error occurred.']);
        }
    }

    public function candidateLoginHistory(Request $request){
        $activities = UserActivity::where('ref_users_id', Auth::id())->whereDate('created_at', Carbon::today())->latest()->take(10)->get();
        $header = true;
        $sidebar = true;
        return view('profile.login_history', compact('activities', 'header', 'sidebar'));
    }

    public function candidateTestData(Request $request)
    {
        if ($request->isMethod('post')) {
            // Handle POST request
            dd($request->all()); // or process the data
        }

        // Handle GET request
        return view('profile.test_data', [
            'header' => true,
            'sidebar' => true,
        ]);
    }

}
