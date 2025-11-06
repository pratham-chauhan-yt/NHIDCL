<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserActivityController;
use App\Http\Requests\CandidateRegstrationRequest;
use App\Mail\NewUserSetPasswordMail;
use App\Models\NhidclTwoFactorVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\NhidclUserStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class RegistrationController extends Controller
{
    public function registration()
    {
        $header = TRUE;
        $sidebar = TRUE;
        $roles = Role::all();
        return view('auth.candidate.registration', compact('header', 'sidebar'));
    }

    public function store(CandidateRegstrationRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $generatedPassword = Str::random(12);
            if (Auth::check()) {
                return redirect()->route('auth.registration')->with('error', 'You are already logged in.');
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
            (new UserActivityController())->logActivity('Account created Successfully, Check your email ID for set new password.', $candidateUser->id);
            if ($request->ajax()) {
                $moduleName = session('moduleName') ?? 'Resource Pool Portal';
                $redirectRoute = $moduleName === 'Recruitment Portal'
                    ? route('recruitment.login')   // your recruitment login route
                    : route('auth.login');         // your candidate/general login route
                return response()->json([
                    'success' => true,
                    "redirect" => $redirectRoute,
                    'message' => 'Access your email ID for further instructions.!'
                ]);
            } else {
                Alert::success('Success', 'Access your email ID for further instructions.!');
                return redirect()->route('auth.registration')->with('success', 'Access your email ID for further instructions.!');
            }
        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('auth.registration')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function createPassword()
    {
        $header = TRUE;
        $sidebar = TRUE;
        return view('auth.passwords.createPassword', compact('header', 'sidebar'));
    }
}
