<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\UserNotificationController;
use App\Models\{Role,User,RefProjectState,RefCourse,RefQualification,RefBoardUniversityCollege,RefMainSubject,RefCourseMode,RefPassingYear,RefAreaExperties,RefJobType};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Log,Mail,Auth,Crypt,Gate,File,Validator,Session};
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\NewUserSetPasswordMail;
use App\Models\{DepartmentMaster,RefEmployeeType,RefOfficeType,RefState,DesignationMaster,UserActivity,Permission,NhidclUserStatus,RoleUser};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Http\Controllers\UserActivityController;
use Exception;
use Carbon\Carbon;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class UserController extends Controller
{
    protected $userNotificationController;

    public function __construct(UserNotificationController $userNotificationController)
    {
        $this->userNotificationController = $userNotificationController;
        $this->middleware('permission:user config - view user|user config - view role')->only(['index']);
        $this->middleware('permission:user config - create user')->only(['create', 'store']);
        $this->middleware('permission:user config - view user|user config - profile')->only(['view']);
        $this->middleware('permission:user config - edit user')->only(['edit', 'update', 'resetPassword']);
        $this->middleware(['role:Super Admin', 'module.permission:user config - delete user'])->only(['destroy']);
        // $this->middleware(function ($request, $next) {
        //     session(['moduleName' => 'User Management System']);
        //     return $next($request);
        // });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userQuery = User::where('is_deleted', '!=', '1')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Super Admin');
            });
        $users = $userQuery->orderBy('id', 'DESC')->get();

        $roles = Role::orderBy('id', 'DESC')->get();
        $totalUser = $userQuery->count();
        $nhidclUser = $userQuery->where('is_nhidcl_employee', '1')->count();
        $otherUser = $totalUser - $nhidclUser;
        $header = true;
        $sidebar = true;
        return view('user-config.index', compact('totalUser', 'nhidclUser', 'otherUser', 'users', 'roles', 'header', 'sidebar'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name', 'asc')->get();
        $department = DepartmentMaster::orderBy('name', 'asc')->get();

        $designation = DesignationMaster::orderBy('name', 'asc')->get();
        $employee_type = RefEmployeeType::orderBy('name', 'asc')->get();
        $office_type = RefOfficeType::orderBy('office_type_name', 'asc')->get();
        $state = RefState::orderBy('name', 'asc')->get();

        $authUser = Auth::user();
        $managerQuery = User::where('is_deleted', '!=', '1')
            ->orderBy('name')
            ->select(['id', 'name', 'email']);

        // If logged in user is Manager
        if ($authUser->hasRole('Manager')) {
            $managerQuery->whereHas('roles', function ($query) {
                $query->where('name', 'General Manager');
            })->where('id', '!=', $authUser->id);
        } else {
            // For other users → only Managers
            $managerQuery->whereHas('roles', function ($query) {
                $query->where('name', 'Manager');
            });
        }
        $managers = $managerQuery->get();
        $manager = $managerQuery->get();

        $header = TRUE;
        $sidebar = TRUE;
        return view('user-config.create', compact('header', 'sidebar', 'department', 'designation', 'employee_type', 'office_type', 'state', 'roles', 'managers', 'manager'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:ref_users,email',
                'mobile_no' => 'required|digits:10|unique:ref_users,mobile',
                'status' => 'required|in:0,1',
                'date_of_birth' => 'required|date|before:today',
                'ref_designation_id' => 'required|integer',
                'ref_department_id' => 'required|integer',
                'address' => 'nullable|string|max:255',
                'ref_office_type_id' => 'required|integer',
                'date_of_joining' => 'required|date',
                'currently_posted' => 'required|integer',
            ]);

            // If validation fails
            //dd($validator->fails());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // 2. Insert data after validation
            $generatedPassword = 'password123'; // Hardcoded password for now

            $insertData = array(
                'name' => htmlspecialchars($request->full_name),
                'email' => htmlspecialchars($request->email),
                'mobile' => $request->mobile_no,
                'date_of_birth' => $request->date_of_birth,
                'ref_designation_id' => $request->ref_designation_id,
                'ref_department_id' => $request->ref_department_id,
                'address' => $request->address,
                'ref_office_type_id' => $request->ref_office_type_id,
                'date_of_joining' => $request->date_of_joining,
                'currently_posted' => $request->currently_posted,
                'is_nhidcl_employee' => $request->is_nhidcl_employee,
                'created_by' => Auth::user()->id,
                'status' => $request->status,
                'password' => bcrypt($generatedPassword),
                'reporting_manager_id' => $request->reporting_manager_id,
                'user_code' => rand() . time(),
            );

            // 3. Create the user
            $user = User::create($insertData);
            /***********Syncing role and parent Role with user */
            $roles = $request->role ?? [];
            $filteredRoles = array_filter($roles, function ($roleId) {
                $role = Role::findByName($roleId);
                return $role && $role->name !== 'Super Admin';
            });

            $rolesWithParentIds = array_map(function ($roleId) {
                $role = Role::findByName($roleId);
                $parentRoleId = $role ? $role->parent_role_id : null;
                return [
                    'role_id' => $role->id,
                    'parent_role_id' => $parentRoleId
                ];
            }, $filteredRoles);
            $user->syncRolesWithLogging($rolesWithParentIds);

            if ($rolesWithParentIds) {
                foreach ($rolesWithParentIds as $role) {
                    $roleUserData = new RoleUser();
                    $roleUserData->ref_user_id = $user->id;
                    $roleUserData->role_id = $role['role_id'];
                    $roleUserData->parent_role_id = $role['parent_role_id'];
                    $roleUserData->save();
                }
            }
            // Assign module name if applicable
            $user->module_name = ($rolesWithParentIds[0]['role_id'] ?? null) == 130
                ? 'Recruitment Portal'
                : null;
            $user->save();
            // Call notifyNewUser after creating a new user
            $this->userNotificationController->notifyNewUser(Auth::id(), $user->id);

            // Generate token and Send the reset link to the user's email
            $token = app('auth.password.broker')->createToken($user);
            try {
                Mail::to($user->email)->send(new NewUserSetPasswordMail($user, $token));
            } catch (TransportExceptionInterface $e) {
                Log::error("OTP mail send failed: " . $e->getMessage());
            }

            // 4. Notify user of success
            Alert::success('Success', "Success! We've sent an email with instructions to access user account.");

            // 5. Redirect to index route
            return redirect()->route('user-config.create');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        try {
            $users = User::with(['roles', 'designation', 'department'])->findOrFail(Crypt::decrypt($id));
            $hasRoles = $users->roles->pluck('id');
            $courses = RefCourse::select('id', 'course_name', "ref_qualification_id")->get();
            $qualifications = RefQualification::select('id', 'qualification_name')->get();
            $board_university_collages = RefBoardUniversityCollege::get();
            $main_subjects = RefMainSubject::get();
            $course_modes = RefCourseMode::get();
            $passing_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
            $area_experties = RefAreaExperties::get();
            $job_types = RefJobType::get();
            $header = true;
            $sidebar = true;
            return view('user-config.show', compact('users', 'hasRoles', 'header', 'sidebar', 'courses', 'qualifications', 'board_university_collages', 'main_subjects','course_modes','passing_years', 'area_experties','job_types'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid user ID provided.');
            return redirect()->route('user-config.index');
        }
    }



    public function edit(string $id)
    {
        try {
            // Safely decrypt the ID
            try {
                $decryptedId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                Log::warning("Invalid encrypted ID provided: {$id}");
                Alert::error('Error', 'Invalid or expired user link.');
                return redirect()->route('user-config.index');
            }

            // Find the user with roles & permissions eager loaded
            $user = User::with(['roles.permissions', 'permissions'])->find($decryptedId);

            if (!$user) {
                Alert::error('Error', 'User not found.');
                return redirect()->route('user-config.index');
            }

            // Prevent role editing for Super Admin
            if ($user->hasRole('Super Admin')) {
                Alert::error('Error', 'Roles for Super Admin cannot be edited.');
                return redirect()->route('user-config.show', $id);
            }

            // Fetch reference/master data in fewer queries
            $department     = DepartmentMaster::orderBy('name')->get();
            $roles          = Role::where('name', '!=', 'Super Admin')->orderBy('name')->get();
            $permissions    = Permission::orderBy('name')->get();
            $designation    = DesignationMaster::orderBy('name')->get();
            $employeeTypes  = RefEmployeeType::orderBy('name')->get();
            $officeTypes    = RefOfficeType::orderBy('office_type_name')->get();
            $states         = RefState::orderBy('name')->get();
            $projectStates  = RefProjectState::all();

            // Collect roles & permissions
            $hasRoles          = $user->roles->pluck('id');
            $rolePermissions   = $user->roles->pluck('permissions')->flatten()->pluck('id');
            $directPermissions = $user->permissions->pluck('id');
            $hasPermissions    = $directPermissions->merge($rolePermissions)->unique();

            // Get dms approvers (with permission filter)
            $dmsApprovers = User::permission('dms-approver')
                ->where('is_nhidcl_employee', true)
                ->where('is_deleted', '!=', 1)
                ->orderBy('name')
                ->get(['id', 'name', 'email']);

            // Get bgms verifiers (with permission filter)
            $bgms_verifiers = User::permission('bgms-verifier-verify')
                ->where('is_nhidcl_employee', true)
                ->where('is_deleted', '!=', 1)
                ->orderBy('name')
                ->get(['id', 'name', 'email']);

            $authUser = Auth::user();
            $managerQuery = User::where('is_deleted', '!=', '1')
                ->orderBy('name')
                ->select(['id', 'name', 'email']);

            // If logged in user is Manager
            if ($authUser->hasRole('Manager')) {
                $managerQuery->whereHas('roles', function ($query) {
                    $query->where('name', 'General Manager');
                });
            } else {
                // For other users → only Managers
                $managerQuery->whereHas('roles', function ($query) {
                    $query->where('name', 'Manager');
                });
            }
            $manager = $managerQuery->where('id', '!=', $authUser->id)->get();
            // Pass data to view
            return view('user-config.edit', [
                'user'          => $user,
                'roles'         => $roles,
                'permissions'   => $permissions,
                'designation'   => $designation,
                'employee_type' => $employeeTypes,
                'office_type'   => $officeTypes,
                'state'         => $states,
                'department'    => $department,
                'projectState'  => $projectStates,
                'hasRoles'      => $hasRoles,
                'hasPermissions'=> $hasPermissions,
                'dms_approvers' => $dmsApprovers,
                'bgms_verifiers'=> $bgms_verifiers,
                'manager'       => $manager,
                'header'        => true,
                'sidebar'       => true,
            ]);

        } catch (\Throwable $e) {
            Log::error("User edit failed: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('user-config.index');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Decrypt the user ID safely
            $decryptedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid user ID provided.');
            return redirect()->route('user-config.index');
        }
        try {
            $user = User::findOrFail($decryptedId);
            // Validate only what’s required
            $validated = $request->validate([
                'is_nhidcl_employee' => 'required|in:0,1',
            ]);


            // Prepare update data (falling back to existing values)
            $updateData = array_merge([
                'name'                 => $user->name,
                'email'                => $user->email,
                'mobile'               => $user->mobile,
                'ref_department_id'    => null,
                'ref_employee_type_id' => null,
                'ref_designation_id'   => null,
                'ref_office_type_id'   => null,
                'date_of_joining'      => null,
                'is_nhidcl_employee'   => null,
                'bgms_assigned_state'  => null,
                'dms_approver_id'      => null,
                'reporting_manager_id' => null,
                'status'               => null,
            ], $request->only([
                'name', 'email', 'mobile',
                'ref_department_id', 'ref_employee_type_id', 'ref_designation_id', 'ref_office_type_id',
                'date_of_joining', 'is_nhidcl_employee', 'bgms_assigned_state',
                'dms_approver_id', 'reporting_manager_id', 'status'
            ]));

            // Adjust mapping for consistency
            $updateData['currently_posted'] = $request->state_id;
            $updateData['updated_by'] = Auth::id();

            // Update user
            $user->update($updateData);

            // Handle roles (except for Super Admin)
            if ($user->hasRole('Super Admin')) {
                Alert::info('Notice', 'Roles for Super Admin cannot be changed.');
                return redirect()->route('user-config.edit', $id)
                    ->with('success', 'Roles for Super Admin cannot be changed');
            }

            // Map roles to IDs + parent IDs
            $rolesWithParentIds = collect($request->role ?? [])
                ->map(function ($roleName) {
                    if ($role = Role::findByName($roleName)) {
                        return [
                            'role_id'        => $role->id,
                            'parent_role_id' => $role->parent_role_id,
                        ];
                    }
                    return null;
                })
                ->filter()
                ->values()
                ->toArray();

                // Sync roles + log activity
                $user->syncRolesWithLogging($rolesWithParentIds);
                $this->storePermissionsToUser($request, $user);

            // Assign module name if applicable
            $user->module_name = ($rolesWithParentIds[0]['role_id'] ?? null) == 130
                ? 'Recruitment Portal'
                : null;
            $user->save();

            (new UserActivityController())->logActivity('User roles updated successfully', $user->id);

            Alert::success('Success', 'User updated successfully');
            return redirect()->route('user-config.edit', $id)
                ->with('success', 'User updated successfully');

        } catch (\Exception $e) {
            Log::error("Error updating user: " . $e->getMessage(), ['exception' => $e]);
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('user-config.edit', $id)
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function storePermissionsToUser(Request $request, User $user)
    {
        try {
            // 1. Validate the input
            $validatedData = $request->validate([
                'permission' => 'nullable|array', // Optional field, must be an array if provided
                'permission.*' => 'string|exists:permissions,name', // Ensure every permission exists
            ]);

            // 2. Assign permissions to the user if provided
            if (!empty($validatedData['permission'])) {
                foreach ($validatedData['permission'] as $permissionName) {
                    // $user->givePermissionTo($permissionName);
                    $user->syncPermissions($validatedData['permission']);
                }
            }

            // 3. Success feedback
            return "Success";
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors specifically
            Log::error("Validation error in storePermissionsToUser: " . $e->getMessage(), ['validation_errors' => $e->validator->errors()]);
            return "Please provide correct user and permission details.";
        } catch (\Exception $e) {
            // Handle errors gracefully
            Log::error("Error in storePermissionsToUser: " . $e->getMessage(), ['exception' => $e]);
            return "Oops, something went wrong. Please try again later.";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find(Crypt::decrypt($id));
            if (!$user) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->back()->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            $user->update(['is_deleted' => '1', 'updated_by' => Auth::user()->id]);

            $this->userNotificationController->notifyDestroyUser(Auth::id(), $user->id);

            Alert::success('Success', 'User deleted successfully');
            return redirect()->route('user-config.view')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Reset password.
     */
    public function resetPassword(string $id)
    {
        try {
            $users = User::find(Crypt::decrypt($id));
            if (!$users) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->back()->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            $plainPassword = Str::random(12);  // Generate a secure password
            $encryptedPassword = bcrypt('password123');
            $users->update(['password' => $encryptedPassword, 'updated_by' => Auth::user()->id]);

            // Send the new password via email
            // Mail::send('emails.password-reset', ['user' => $users, 'password' => $plainPassword], function ($message) use ($users) {
            //     $message->to($users->email)
            //         ->subject('Your password has been reset');
            // });

            Alert::success('Success', 'New password has been sent to your registered email address.');
            return redirect()->back()->with('success', 'New password has been sent to your registered email address.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Alert::error('Error', 'Invalid user ID. Please try again.');
            return redirect()->back()->withErrors(['msg' => ['Invalid user ID.']]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Display list of users with edit rights.
     */
    public function view(Request $request)
    {
        // If the request is an AJAX call for DataTables
        if ($request->ajax()) {
            if ($request->has('download') && $request->download == 'excel') {
                return $this->export($request);
            }

            $users = User::where('is_deleted', '!=', '1')
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'Super Admin');
                })
                ->select([
                    'id',
                    'name',
                    'email',
                    'mobile',
                    'ref_department_id',
                    'is_logged',
                    'ref_employee_type_id'
                ])
                ->with('roles'); // Eager loading roles to optimize queries
            if ($request->has('search') && $request->search != '') {
                $searchTerm = '%' . trim($request->search) . '%';

                $users->where(function ($query) use ($searchTerm) {
                    $query->whereRaw('email ILIKE ?', [$searchTerm])
                        ->orWhereRaw('mobile ILIKE ?', [$searchTerm])
                        ->orWhereRaw('name ILIKE ?', [$searchTerm]);
                });
            }

            if ($request->has('email') && $request->email != '') {
                $users->whereRaw('email ILIKE ?', ['%' . trim($request->email) . '%']);
            }

            if ($request->has('mobile') && $request->mobile != '') {
                $users->where('mobile', 'like', '%' . $request->mobile . '%');
            }

            if ($request->has('department') && $request->department != '') {
                $users->where('ref_department_id', (int)$request->department);
            }

            if ($request->has('role') && $request->role != '') {
                $users->whereHas('roles', function ($query) use ($request) {
                    $query->where('roles.id', $request->role); // Filter based on role ID
                });
            }
            $users = $users->orderBy('id', 'DESC')->get();
            
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('user-config.show', Crypt::encrypt($row->id));
                    $editUrl = route('user-config.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('user-config.destroy', Crypt::encrypt($row->id));

                    $actionBtn = '<a href="' . $showUrl . '" class="btn btn-info btn-sm">View</a>';

                    if (Gate::allows('user config - edit user'))
                        $actionBtn .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';

                    if (Auth::user()->hasRole('Super Admin')) {
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->email . '\')">Delete</a>';
                        $actionBtn .= '<form id="delete-form-' . $row->email . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    }
                    return $actionBtn;
                })
                ->editColumn('department_master_id', function ($row) {
                    return $row->department->name ?? '';
                    //return getDepartmentNameById($row->ref_department_id);
                })
                ->editColumn('roles', function ($row) {
                    return $row->roles->pluck('name')->implode(', ');
                })
                // ->editColumn('is_logged', function ($row) {
                //     return $row->status ?? 'NA';
                // })
                // ->editColumn('is_nhidcl_employee', function ($row) {
                //     return $row->is_nhidcl_employee ? 'Yes' : 'No';
                // })
                ->editColumn('employee_type_id', function ($row) {
                    return getEmployeeTypeNameById($row->ref_employee_type_id);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::get();
        $departments = DepartmentMaster::get();

        // Render the view with the DataTables setup
        $header = TRUE;
        $sidebar = TRUE;
        return view('user-config.view', compact('header', 'sidebar', 'roles', 'departments'));
    }

    // public function view(Request $request)
    // {
    //     $users = User::where('is_deleted', '!=', '1')->orderBy('name', 'asc')->get();
    //     $header = TRUE;
    //     $sidebar = TRUE;
    //     return view('user-config.view', compact('header', 'sidebar','users'));
    // }
    public function searchUsersByRole()
    {
        // $UserId = Session::get('ref_user_id');



        //  $users = User::where('user_code', $UserId)->get();

        $users = User::whereNull('user_code')->get();
        //  $user = User::find($users->id);
        //$user = User::with(['creator', 'updater', 'roles'])->findOrFail($users->id);
        //dd($user);
        //$hasRoles = $user->roles->pluck('id');




        $rows = '';
        if ($users->isEmpty()) {
            $rows .= '<tr><td colspan="3">No users found for this role.</td></tr>';
        } else {
            foreach ($users as $user) {
                // $roles = $user->roles->pluck('name')->implode(', ');

                $rows .= "<tr>
                           <td>{$user->id}</td>
                           <td>{$user->name}</td>
                           <td>Pending</td>
                           <td>
                           <a href='" . route('user.profile', $user->id) . "' class='btn btn-info'>View Profile</a>
                           </td>
                           <td><input type='checkbox' id='selected_{$user->id}' name='selected[]' value='{$user->id}'></td>
                       </tr>";
            }
        }

        return response()->json(['html' => $rows]);  // Return rows as HTML
    }

    public function searchShortListedUsersByRole()
    {
        $UserId = Session::get('ref_user_id');

        //$users = User::where('user_code', $UserId)->get();
        $users = User::where('user_code', 5)->get();
        // dd($users);
        $rows = '';
        if ($users->isEmpty()) {
            $rows .= '<tr><td colspan="3">No users found for this role.</td></tr>';
        } else {
            foreach ($users as $user) {
                $roles = $user->roles->pluck('name')->implode(', ');
                $rows .= "<tr>
                           <td>{$user->id}</td>
                           <td>{$user->name}</td>
                           <td>Pending</td>
                           <td>
                           <a href='" . route('user.profile', $user->id) . "' class='btn btn-info'>View Profile</a>
                           </td>
                           <td><input type='checkbox' id='selected_{$user->id}' name='selected[]' value='{$user->id}'></td>
                       </tr>";
            }
        }

        return response()->json(['html' => $rows]);  // Return rows as HTML
    }

    public function updateUserStatus(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            //  'user_ids.*' => 'integer|exists:ref_interview_status_id,User_id',
            //  'status' => 'required|string|in:active,inactive,suspended',
        ]);

        $userIds = $validated['user_ids'];
        // $status = $validated['status'];

        try {

            $updatedRows = NhidclUserStatus::whereIn('ref_users_id', $userIds)
                ->update(['ref_interview_status_id' => 5]);

            if ($updatedRows > 0) {
                return response()->json(['message' => 'Users\' status updated successfully']);
            } else {
                return response()->json(['message' => 'No users were updated'], 400);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function showUserProfile($id)
    {

        $header = TRUE;
        $sidebar = TRUE;
        $users = User::find($id);

        if ($users) {
            return view('hr.CandidateUserData', compact('users', 'header', 'sidebar'));
        } else {
            echo "User not found.";
        }
    }

    public function export(Request $request)
    {
        $filters = $request->only(['email', 'mobile', 'department', 'role']);
        return Excel::download(new UsersExport($filters), 'users.xlsx');
    }

    public function loginHistory(Request $request)
    {
        $header = TRUE;
        $sidebar = TRUE;

        if ($request->ajax()) {
            // Start query
            $query = UserActivity::query(); // don't use latest() if DataTables handles sorting

            // Restrict for non-Super Admin users
            if (!Auth::user()->hasRole('Super Admin')) {
                $query->where('ref_users_id', Auth::user()->id);
            }

            // Apply user filter
            if ($request->filled('user_id')) {
                $query->where('ref_users_id', $request->user_id);
            }

            // Apply date range filter
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $start = Carbon::parse($request->start_date)->startOfDay();
                $end = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start, $end]);
            }

            return DataTables::of($query)
                ->addIndexColumn()

                // Users column (relationship)
                ->addColumn('users', fn($row) => $row->user->name ?? 'N/A')
                ->filterColumn('users', function ($query, $keyword) {
                    $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$keyword}%"));
                })

                // Created at column
                ->orderColumn('created_at', fn($query, $order) =>
                    $query->orderBy('nhidcl_user_activities.created_at', $order)
                )
                ->editColumn('created_at', fn($row) => $row->created_at ? $row->created_at->format('d-m-Y H:i:s A') : null)

                // Other simple columns
                ->addColumn('browser', fn($row) => $row->browser ?? 'N/A')
                ->addColumn('platform', fn($row) => $row->platform ?? 'N/A')
                ->addColumn('activity', fn($row) => $row->activity ?? 'N/A')
                ->addColumn('ip_address', fn($row) => $row->ip_address ?? 'N/A')

                ->make(true);
        }

        $users = User::all(); // For dropdown
        return view('user-config.login-history', compact('users', 'header', 'sidebar'));
    }

    public function showLogs(Request $request)
    {
        $filename = $request->get('filename', 'laravel.log');
        $path = storage_path("logs/{$filename}");

        if (!File::exists($path)) {
            abort(404, 'Log file not found');
        }

        $limit = 500; // lines per page
        $page = (int) $request->get('page', 1);

        $lines = [];
        $totalLines = 0;

        $handle = fopen($path, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $lines[] = $line;
                $totalLines++;
            }
            fclose($handle);
        }

        // Calculate slice for pagination
        $lines = array_slice($lines, -$limit * $page, $limit);

        return view('user-config.show-logs', [
            'content' => implode('', $lines),
            'filename' => $filename,
            'page' => $page,
            'hasMore' => $totalLines > $limit * $page
        ]);
    }


    public function clearLogs(Request $request)
    {
        $filename = $request->get('filename', 'laravel.log');
        $path = storage_path("logs/{$filename}");
        if (File::exists($path)) {
            File::put($path, ''); // Clear file
        }

        return redirect()->route('users.logs.show')->with('success', 'Log file cleared successfully.');
    }
}
