<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\UserActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


    protected function resetPassword($user, $password)
    {
        // Apply hashing (custom salt logic)
        $salt = session('salt');
        if (!$salt) {
            return redirect()->route('password.reset', [
                'token' => request('token')
            ])->withInput(request()->only('email'))->withErrors(['password' => 'Missing session salt. Please reload the page and try again.']);
        }
        $encrypted = $password;
        $rawKey = session('salt'); // e.g. "3482"

        if (!$rawKey || strlen($rawKey) !== 4) {
            return redirect()->route('password.reset', [
                'token' => request('token')
            ])->withInput(request()->only('email'))->withErrors(['password' => 'Invalid session key']);
        }

        // Pad the 4-digit key to 16 bytes (same way as frontend)
        $fullKey = str_repeat($rawKey, 4); // "3482348234823482"

        $key = $fullKey; // string
        $iv = $fullKey;

        $cipherText = base64_decode($encrypted);
        $decrypted = openssl_decrypt(
            $cipherText,
            'aes-128-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        if (!$decrypted) {
            return redirect()->route('password.reset', [
                'token' => request('token')
            ])->withInput(request()->only('email'))->withErrors(['password' => 'Invalid password format.']);
        }
        $hashedPassword = Hash::make($decrypted);
        $userdata = User::find($user->id);
        if ($userdata) {
            $userdata->password = $hashedPassword;
            $userdata->save();
            (new UserActivityController())->logActivity('User account password change successfully', $user->id);
            Alert::success('Success', 'Account password update successfully, Now you can login.');
        }
    }

    public function resetFormPassword(Request $request)
    {
        // 🔹 Step 1: Decrypt the incoming password fields using session salt
        $decryptedPassword = decryptPassword($request->input('password'), session('salt'));
        $decryptedPasswordConfirmation = decryptPassword($request->input('password_confirmation'), session('salt'));

        // Replace request input values with decrypted passwords
        $request->merge([
            'password' => $decryptedPassword,
            'password_confirmation' => $decryptedPasswordConfirmation,
        ]);

        // 🔹 Step 2: Validate input (including email, token, captcha, and password rules)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:ref_users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),

                // Custom password rule logic
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('email', $request->email)->first();
                    $userName = strtolower(trim($user->name ?? ''));
                    $passwordLower = strtolower($value);

                    // No 3+ consecutive letters/numbers
                    if (preg_match('/(012|123|234|345|456|567|678|789|abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz)/i', $value)) {
                        $fail('The '.$attribute.' cannot contain three or more consecutive letters or numbers (e.g., 123, abc).');
                    }

                    // Should not include any part of the user's name
                    $nameParts = array_filter(explode(' ', $userName));
                    foreach ($nameParts as $part) {
                        if (!empty($part) && str_contains($passwordLower, $part)) {
                            $fail('The '.$attribute.' should not include your first or last name.');
                            break;
                        }
                    }
                },
            ],
            'token' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'password.confirmed' => 'Password and confirmation do not match.',
        ]);
        $token = $request->input('token');
        $email = $request->input('email');
        $redirectUrl = route('password.reset', ['token' => $token]) . '?email=' . urlencode($email);

        if ($validator->fails()) {
            return redirect()->to($redirectUrl)
                ->withErrors($validator)
                ->withInput();
        }

        // 🔹 Step 3: Find the user (excluding Recruitment Portal)
        $user = User::where('email', $request->email)
        ->when(true, function ($q) {
            $q->where(function ($query) {
                $query->where('module_name', 'Recruitment Portal')
                    ->orWhereNull('module_name');
            });
        })
        ->first();
        if (!$user) {
            return redirect()->to($redirectUrl)->withErrors(['email' => 'User not found.']);
        }
        // 🔹 Step 4: Verify reset token manually
        $reset = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return redirect()->to($redirectUrl)->withErrors(['error' => 'Invalid or expired token.']);
        }
        
        // 🔹 Step 5: Update password
        $user->password = Hash::make($decryptedPassword);
        $user->save();

        // 🔹 Step 6: Delete the token after success
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
    }
}
