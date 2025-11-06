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
            return redirect()->route('candidate.change-password');
        }
    }

    public function resetBackend(Request $request)
    {    
        $user = User::find($request->u_id);
        if (!$user) {
            Alert::error('Error', 'User not found.');
            return redirect()->route('candidate.change-password')->withErrors(['error' => 'User not found']);
        }
        $nameParts = explode(' ', strtolower($user->name ?? ''));
        //1. Validate outside try-catch so Laravel handles it natively
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/',
                function ($attribute, $value, $fail) use ($nameParts) {
                    $password = strtolower($value);
                    foreach ($nameParts as $part) {
                        if (strlen($part) > 2 && str_contains($password, $part)) {
                            $fail('The password should not contain your first & last name.');
                            break;
                        }
                    }
                },
            ],
            'captcha' => 'required|captcha',
        ], [
            'password.regex' => 'Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'Invalid captcha code.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('candidate.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $rateLimitKey = $request->u_id . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->route('password.request')->withErrors(['error' => "Too many reset password attempts. Please try again 24 hours."]);
        }

        try {
            
            $currentPassword = $request->input('current_password');
            $rawKey = session('salt'); // e.g. "3482"

            if (!$rawKey || strlen($rawKey) !== 4) {
                return redirect()->route('candidate.change-password')->withErrors(['current_password' => 'Invalid session key']);
            }

            // Pad the 4-digit key to 16 bytes (same way as frontend)
            $fullKey = str_repeat($rawKey, 4); // "3482348234823482"
            $key = $fullKey; // string
            $iv = $fullKey;

            $cipherText = base64_decode($currentPassword);
            $decryptCurrentPassword = openssl_decrypt(
                $cipherText,
                'aes-128-cbc',
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );
            
            if (!$decryptCurrentPassword) {
                return redirect()->route('candidate.change-password')->withErrors(['current_password' => 'Invalid current password format.']);
            }
            if (!Hash::check($decryptCurrentPassword, $user->password)) {
                Alert::error('Error', 'The current password is incorrect.');
                return redirect()->route('candidate.change-password')->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if ($request->current_password === $request->password) {
                Alert::error('Error', 'New password cannot be the same as the old password.');
                return redirect()->route('candidate.change-password')->withErrors(['password' => 'New password cannot be the same as the old password.']);
            }

            // Log the password change
            //Log::info('Password changed successfully for user ID: ' . $user->id);
            (new UserActivityController())->logActivity('User account password change successfully', $user->id);

            // Logout other sessions before changing password
            Session::where('user_id', $user->id)->delete();
            Auth::logoutOtherDevices($decryptCurrentPassword);

            $newPassword = $request->input('password');;
            $cipherNewText = base64_decode($newPassword);
            $decryptNewPassword = openssl_decrypt(
                $cipherNewText,
                'aes-128-cbc',
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );
            $user->update([
                'password' => Hash::make($decryptNewPassword),
            ]);
            RateLimiter::hit($rateLimitKey, 1200);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('auth.login')->with('success', 'Password changed successfully. Please log in again.');
        } catch (\Exception $e) {
            Log::error('Password change failed for user ID: ' . $request->u_id . ' - ' . $e->getMessage());

            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('candidate.change-password')->withErrors(['error' => 'Internal error occurred.']);
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
