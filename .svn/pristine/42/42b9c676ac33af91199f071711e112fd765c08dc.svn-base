<?php

namespace App\Http\Controllers\DirectoryManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\DepartmentMaster;
use App\Models\RefEmployeeType;
use App\Models\RefOfficeType;
use App\Models\RefState;
use App\Models\DesignationMaster;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Crypt;
use Exception;

class DirectoryManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Directory Management']);
        $this->middleware('module.permission:directory-view')->only(['stakeholderList']);
    }

    public function stakeholderList(Request $request)
    {
        $header = true;
        $sidebar = true;
        return view('directory-management.directory-list', compact('header', 'sidebar'));
    }

    public function externalEmployeeCreate(Request $request){
        if ($request->ajax()) {
            $users = User::where('is_deleted', '!=', '1')
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'NHIDCL Employee');
                })
                ->select([
                    'id',
                    'name',
                    'email',
                    'mobile',
                    'ref_designation_id',
                    'ref_department_id',
                    'currently_posted',
                    'address',
                    'userid_status',
                ])
                ->with('roles'); // Eager loading roles to optimize queries
            $users = $users->orderBy('id', 'DESC')->get();

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('directory-management.external.employees.edit', Crypt::encrypt($row->id));
                $actionBtn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';
                return $actionBtn;
            })
            ->editColumn('department_master', function ($row) {
                return $row->department?->name ?? '';
            })
            ->editColumn('designation_master', function ($row) {
                return $row->designation?->name ?? '';
            })
            ->editColumn('posting_master', function ($row) {
                return $row->posting?->name ?? '';
            })
            ->editColumn('status_master', function ($row) {
                return $row->userid_status ?? 'Pending';
            })
            ->editColumn('roles', function ($row) {
                return $row->roles->pluck('name')->implode(', ');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        if (!auth()->user()->can(['external-user-create', 'external-user-view', 'external-user-edit'])) {
            abort(403, 'You do not have permission to access this modules.');
        }

        $roles = Role::where('name', '!=', 'Super Admin')->where('name', 'NHIDCL Employee')->orderBy('name', 'asc')->get();
        $department = DepartmentMaster::orderBy('name', 'asc')->get();
        $designation = DesignationMaster::orderBy('name', 'asc')->get();
        $emptype = RefEmployeeType::orderBy('name', 'asc')->get();
        $officetype = RefOfficeType::orderBy('office_type_name', 'asc')->get();
        $state = RefState::orderBy('name', 'asc')->get();
        $header = TRUE;
        $sidebar = TRUE;
        return view('directory-management.employee-create', compact('header', 'sidebar', 'roles', 'department', 'designation', 'emptype', 'officetype', 'state'));
    }

    public function externalEmployeeStore(Request $request){
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:ref_users,email',
                'mobile_no' => 'required|digits:10|unique:ref_users,mobile',
                'date_of_birth' => 'required|date|before:today',
                'designation' => 'required|integer',
                'department' => 'required|integer',
                'state' => 'required|integer',
                'address' => 'nullable|string|max:255',
            ]);
            
            // 2. Insert data after validation
            $generatedPassword = 'password123'; // Hardcoded password for now
            $insertData = array(
                'name' => htmlspecialchars($validated['full_name']),
                'email' => htmlspecialchars($validated['email']),
                'mobile' => $validated['mobile_no'],
                'date_of_birth' => $validated['date_of_birth'],
                'ref_designation_id' => $validated['designation'],
                'ref_department_id' => $validated['department'],
                'currently_posted' => $validated['state'],
                'address' => $validated['address'],
                'created_by' => auth()->user()->id,
                'userid_status' => '1',
                'password' => bcrypt($generatedPassword),
                'user_code' => rand() . time(),
            );
            
            // 3. Create the user
            $user = User::create($insertData);
            /*********** Syncing role and parent Role with user ***********/
            $role = Role::find($request->roles);
            if ($role) {
                // Spatie sync by role name
                $user->syncRoles([$role->name]);  

                // Insert into your custom table
                RoleUser::create([
                    'ref_user_id'   => $user->id,
                    'role_id'       => $role->id,
                    'parent_role_id'=> $role->parent_role_id,
                ]);
            }          
            Alert::success('Success', 'External employee created successfully');
            return redirect()->route('directory-management.external.employees.create');
        } catch (Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('directory-management.external.employees.create')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function externalEmployeeEdit($id, Request $request){
        if (!auth()->user()->can('external-user-edit')) {
            abort(403, 'You do not have permission to access this modules.');
        }
        $recordId = Crypt::decrypt($id);
        $users = User::find($recordId);
        $roles = Role::where('name', '!=', 'Super Admin')->where('name', 'NHIDCL Employee')->orderBy('name', 'asc')->get();
        $department = DepartmentMaster::orderBy('name', 'asc')->get();
        $designation = DesignationMaster::orderBy('name', 'asc')->get();
        $emptype = RefEmployeeType::orderBy('name', 'asc')->get();
        $officetype = RefOfficeType::orderBy('office_type_name', 'asc')->get();
        $state = RefState::orderBy('name', 'asc')->get();
        $header = true;
        $sidebar = true;
        return view('directory-management.employee-edit', compact('header', 'sidebar', 'users', 'roles', 'department', 'designation', 'emptype', 'officetype', 'state'));
    }

    public function externalEmployeeUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id); // better than just find()
        try {
            // Validation (ignore unique check for the same user)
            $validated = $request->validate([
                'full_name'     => 'required|string|max:255',
                'email'         => 'required|email|unique:ref_users,email,' . $id,
                'mobile_no'     => 'required|digits:10|unique:ref_users,mobile,' . $id,
                'date_of_birth' => 'required|date|before:today',
                'designation'   => 'required|integer',
                'department'    => 'required|integer',
                'state'         => 'required|integer',
                'address'       => 'nullable|string|max:255',
                'roles'         => 'required|integer'
            ]);

            // Prepare update data
            $updateData = [
                'name'              => htmlspecialchars($validated['full_name']),
                'email'             => htmlspecialchars($validated['email']),
                'mobile'            => $validated['mobile_no'],
                'date_of_birth'     => $validated['date_of_birth'],
                'ref_designation_id'=> $validated['designation'],
                'ref_department_id' => $validated['department'],
                'currently_posted'  => $validated['state'],
                'address'           => $validated['address'] ?? null,
            ];

            // Update the user
            $user->update($updateData);

            // Sync role
            $role = Role::find($validated['roles']);
            if ($role) {
                $user->syncRoles([$role->name]);  

                // Delete old role-user mapping (avoid duplicates)
                RoleUser::where('ref_user_id', $user->id)->delete();

                // Insert updated mapping
                RoleUser::create([
                    'ref_user_id'   => $user->id,
                    'role_id'       => $role->id,
                    'parent_role_id'=> $role->parent_role_id,
                ]);
            }

            Alert::success('Success', 'External employee updated successfully');
            return redirect()->route('directory-management.external.employees.create');

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('directory-management.external.employees.create')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
    public function internalEmployeeDataList(Request $request){
        if ($request->ajax()) {
            $users = User::where('is_deleted', '!=', '1')
                ->whereHas('officeType', function ($query) {
                    $query->whereIn('name', ['HQ', 'RO', 'PMO']);
                })
                ->select([
                    'id',
                    'name',
                    'email',
                    'mobile',
                    'ref_designation_id',
                    'ref_department_id',
                    'currently_posted',
                    'ref_office_type_id',
                    'address',
                ])
                ->with('roles', 'officeType'); // Eager loading roles to optimize queries
            $users = $users->orderBy('id', 'DESC')->get();

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('user-config.edit', Crypt::encrypt($row->id));
                $actionBtn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';
                return $actionBtn;
            })
            ->editColumn('department_master', function ($row) {
                return $row->department?->name ?? '';
            })
            ->editColumn('designation_master', function ($row) {
                return $row->designation?->name ?? '';
            })
            ->editColumn('posting_master', function ($row) {
                return $row->posting?->name ?? '';
            })
            ->editColumn('office_master', function ($row) {
                return $row->officeType?->name ?? '';
            })
            ->editColumn('roles', function ($row) {
                return $row->roles->pluck('name')->implode(', ');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}