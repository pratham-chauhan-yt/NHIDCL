<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:User Management']);
        $this->middleware('module.permission:roles-view')->only(['index']);
        $this->middleware('module.permission:roles-create')->only(['create', 'store']);
        $this->middleware('module.permission:roles-edit')->only(['edit', 'update']);
        $this->middleware(['role:Super Admin', 'module.permission:roles-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name', 'asc')->get();

            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('roles.show', Crypt::encrypt($row->id));
                    $editUrl = route('roles.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('roles.destroy', Crypt::encrypt($row->id));

                    $actionBtn = '<a href="' . $showUrl . '" class="btn btn-info btn-sm">View</a>';

                    if (Gate::allows('user config - edit role'))
                        $actionBtn .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';

                    if (Auth::user()->hasRole('Super Admin')) {
                        $actionBtn .= '<a  class="btn btn-danger btn-sm" href="javascript:void(0)" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>';
                        $actionBtn .= '<form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    }
                    return $actionBtn;
                })
                // ->editColumn('permissions', function ($row) {
                //     $first10Permissions = $row->permissions->slice(0, 10);
                //     return $first10Permissions->pluck('name')->implode(', ');
                // })

                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        return view('roles.index', compact('header', 'sidebar'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('module', 'ASC')->get()->groupBy('module');
        $header = TRUE;
        $sidebar = TRUE;
        return view('roles.create', compact('header', 'sidebar', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // 1. Validate the input
            $validatedData = $request->validate([
                'name' => 'required|unique:roles|min:3|max:255', // Ensure name is unique and follows length constraints
                'permission' => 'nullable|array', // Optional field, must be an array if provided
                'permission.*' => 'string|exists:permissions,name', // Ensure every permission exists
            ]);

            // 2. Sanitize and prepare the role name
            $roleName = htmlspecialchars($validatedData['name']);

            // 3. Create the role
            $role = Role::create(['name' => $roleName]);

            // 4. Assign permissions to the role if provided
            if (!empty($validatedData['permission'])) {
                foreach ($validatedData['permission'] as $permissionName) {
                    $role->givePermissionTo($permissionName);
                }
            }

            // 5. Success feedback
            Alert::success('Success', 'Role added successfully');
            return redirect()->route('roles.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors specifically
            Alert::error('Error', 'There were validation errors');

            // Redirect back with input and validation errors
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // 6. Handle errors gracefully
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
            $role = Role::findOrFail(Crypt::decrypt($id));
            $hasPermissions = $role->permissions->pluck('name');
            $permissions = Permission::orderBy('name', 'asc')->get();
            $sidebar = TRUE;
            $header = True;
            return view('roles.show', compact('header', 'sidebar', 'role', 'hasPermissions', 'permissions'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $role = Role::findOrFail(Crypt::decrypt($id));
            $hasPermissions = $role->permissions->pluck('name');
            $permissions = Permission::orderBy('module', 'ASC')->get()->groupBy('module');
            $sidebar = TRUE;
            $header = True;
            return view('roles.edit', compact('header', 'sidebar', 'role', 'hasPermissions', 'permissions'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $roleId)
    {

       try {

            $id = Crypt::decrypt($roleId);
            $role = Role::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|unique:roles,name,' . $id . ',id|min:2|max:255',
                'permission' => 'nullable|array',
                'permission.*' => 'string|exists:permissions,name',
            ]);

            $role->name = $request->name;
            $role->save();

            if (!empty($validatedData['permission'])) {

                $role->syncPermissionsWithLogging($validatedData['permission']);
                //$role->syncPermissionsWithLogging($request->permission);
            } else {
                $role->syncPermissionsWithLogging([]);
                // $role->syncPermissions([]);
            }

            Alert::success('Success', 'Role updated successfully');
            return redirect()->route('roles.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'There were validation errors');
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        try {
            $role = Role::find(Crypt::decrypt($id));
            if (!$role) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('roles.index');
            }
            // Detach role from all models (usually users)
            DB::table('model_has_roles')->where('role_id', $role->id)->delete();
            $role->delete();
            Alert::success('Success', 'Role deleted successfully');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('roles.index');
        }
    }
}
