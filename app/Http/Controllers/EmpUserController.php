<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\UserNotificationController;
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
use App\Models\DesignationMaster;
use App\Models\RefState;
use App\Models\EmployeeProfile;

class EmpUserController extends Controller
{

    protected $userNotificationController;

    // public function __construct(UserNotificationController $userNotificationController)
    // {
    //     $this->userNotificationController = $userNotificationController;

    // }

    public function index(Request $request)
    {
        try {
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $designation = DesignationMaster::orderBy('name', 'asc')->get();
            $state = DB::table('state_master')->orderBy('name', 'asc')->get();
            $office_type = DB::table('category_master')->orderBy('name', 'asc')->get();
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('emp-user.index', compact('header', 'sidebar','department','designation','state','office_type','roles'));

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later..');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'captcha' => 'required|captcha',
            ]);

            $generatedPassword = 'password123';

            $insertDataEmployee = array(

                'first_name' => htmlspecialchars($validatedData['first_name']),
                'last_name' =>  htmlspecialchars($validatedData['last_name']),
                'email' =>  htmlspecialchars($validatedData['email']),
                'qualification' => $request->qualification,
                'designation_id' => $request->designation_id,
                'employee_type' => $request->employee_type,
                'date_of_joining'  => $request->date_of_joining,
                'date_completion_tenure' => $request->date_completion_tenure,
                'category' => $request->category,
                'date_of_birth' => $request->date_of_birth,
                'date_of_retirement' => $request->date_of_retirement,
                'contact_number' => $request->contact_number,
                'employee_code' => $request->employee_code,
                'parent_department_id' => $request->parent_department_id,
                'place_of_posting'=> $request->place_of_posting,
                'date_of_posting' => $request->date_of_posting,
                'record_previous_posting'=> $request->record_previous_posting,
                'department_id' => $request->department_id,
                'role_id' => $request->role_id,
                'last_activity_time' => $request->last_activity_time,
                'userid_status' => $request->userid_status,
                'office_type' => $request->office_type,
                'state_id' => $request->state_id,
                'created_by' => Auth::user()->id,
                'created_at' => now()
            );

            $insertData = array(
                'name' => htmlspecialchars($validatedData['first_name']),
                'email' =>  htmlspecialchars($validatedData['email']),
                'user_id' => $request->employee_code,
                'department_master_id' => $request->department_id,
                'mobile' => $request->contact_number,
                'is_nhidcl_employee' => 1,
                'created_by' => Auth::user()->id,
                'userid_status' => $request->userid_status,
                'password' => bcrypt($generatedPassword),
             //  'password' => hash('sha256', $generatedPassword.session('salt')),
            );


            $empUser = EmployeeProfile::create($insertDataEmployee);

            $user = User::create($insertData);
            // $this->userNotificationController->notifyNewUser(Auth::id(), $user->id);
            Alert::success('Success', 'User created successfully');
            return redirect()->route('user-emp.create');

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function view(Request $request)
    {
        try
        {
            if($request->ajax())
            {

              $totalDataQry = EmployeeProfile::get();
                $final_data = $totalDataQry;
                $datatables =  DataTables::of($final_data);
                $datatables->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->first_name.' '.$row->last_name;
                })
                ->addColumn('last_name', function ($row) {
                    return $row->last_name;
                })
                ->addColumn('qualification', function ($row) {
                    return $row->qualification;
                })
                ->addColumn('designation_id', function ($row) {
                    return getDesignationameById($row->designation_id);
                })
                ->addColumn('employee_type', function ($row) {
                    return $row->employee_type;
                })
                ->addColumn('date_of_joining', function ($row) {
                    return $row->date_of_joining;
                })
                ->addColumn('date_completion_tenure', function ($row) {
                    return $row->date_completion_tenure;
                })
                ->addColumn('category', function ($row) {
                    return $row->category;
                })
                ->addColumn('date_of_birth', function ($row) {
                    return $row->date_of_birth;
                })
                ->addColumn('date_of_retirement', function ($row) {
                    return $row->date_of_retirement;
                })
                ->addColumn('employee_code', function ($row) {
                    return $row->employee_code;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('contact_number', function ($row) {
                    return $row->contact_number;
                })
                ->addColumn('parent_department_id', function ($row) {
                    return getDepartmentNameById($row->parent_department_id);
                })
                ->addColumn('place_of_posting', function ($row) {
                    return $row->place_of_posting;
                })
                ->addColumn('date_of_posting', function ($row) {
                    return $row->date_of_posting;
                })
                ->addColumn('record_previous_posting', function ($row) {
                    return $row->record_previous_posting;
                })
                ->addColumn('department_id', function ($row) {
                    return getDepartmentNameById($row->department_id);
                })
                ->addColumn('role_id', function ($row) {
                    return getRoleByNameId($row->role_id);
                })
                ->addColumn('last_activity_time', function ($row) {
                    return $row->last_activity_time;
                })
                ->addColumn('userid_status', function ($row) {
                    return getUserStatusId($row->userid_status);
                })
                ->addColumn('office_type', function ($row) {
                    return getOfficeTypeNameById($row->office_type);
                })
                ->addColumn('state_id', function ($row) {
                    return getStateByNameId($row->state_id);
                })
                ->addColumn('action', function ($row) {

                     $enc_id = Crypt::encrypt($row->id);

                     $btn_edit = '<a href="' .route('user-emp.edit', $enc_id). '"><span><i class="fa fa-pencil text-muted fs-16 align-middle me-1" data-toggle="tooltip" title="Edit Individual User"></i></span></a>';

                     $btn_view =  '<a href="' .route('user-emp.show', $enc_id). '"><i class="fa fa-eye align-bottom text-success" title="View"></a>';

                    return $btn_edit . ' ' . $btn_view;
                })
                ->rawColumns(['action']);

            return $datatables->make(true);
        }


        $header = TRUE;
        $sidebar = TRUE;
        return view('emp-user.view', compact('header', 'sidebar'));

            } catch (Exception $e) {
                Log::error($e);
                Alert::error('Error', 'Something went wrong, Please try again');
                return redirect()->back();
            }

    }


    public function edit($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $employeelist = EmployeeProfile::find($decryptedId);
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $designation = DesignationMaster::orderBy('name', 'asc')->get();
            $state = DB::table('state_master')->orderBy('name', 'asc')->get();
            $office_type = DB::table('category_master')->orderBy('name', 'asc')->get();
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('emp-user.edit', compact('header', 'sidebar','department','designation','state','office_type','employeelist','roles'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('user-emp.view');
        }

    }
    public function show($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $employeelist = EmployeeProfile::find($decryptedId);
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $designation = DesignationMaster::orderBy('name', 'asc')->get();
            $state = DB::table('state_master')->orderBy('name', 'asc')->get();
            $office_type = DB::table('category_master')->orderBy('name', 'asc')->get();
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('emp-user.show', compact('header', 'sidebar','department','designation','state','office_type','employeelist','roles'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('user-emp.view');
        }

    }

    public function update(Request $request){

     try {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users,email',
            'captcha' => 'required|captcha',
        ]);
        $id = $request->id;
        $updateDataEmployee = array(
            'first_name' => htmlspecialchars($validatedData['first_name']),
            'last_name' =>  htmlspecialchars($validatedData['last_name']),
            // 'email' =>  htmlspecialchars($validatedData['email']),
            'qualification' => $request->qualification,
            'designation_id' => $request->designation_id,
            'employee_type' => $request->employee_type,
            'date_of_joining'  => $request->date_of_joining,
            'date_completion_tenure' => $request->date_completion_tenure,
            'category' => $request->category,
            'date_of_birth' => $request->date_of_birth,
            'date_of_retirement' => $request->date_of_retirement,
            'contact_number' => $request->contact_number,
            'employee_code' => $request->employee_code,
            'parent_department_id' => $request->parent_department_id,
            'place_of_posting'=> $request->place_of_posting,
            'date_of_posting' => $request->date_of_posting,
            'record_previous_posting'=> $request->record_previous_posting,
            'department_id' => $request->department_id,
            'role_id' => $request->role_id,
            'last_activity_time' => $request->last_activity_time,
            'userid_status' => $request->userid_status,
            'office_type' => $request->office_type,
            'state_id' => $request->state_id,
            'created_by' => Auth::user()->id,
            'created_at' => now()
         );
            $empUser = EmployeeProfile::where('id',$id)->update($updateDataEmployee);

            // $this->userNotificationController->notifyNewUser(Auth::id(), $id);

            Alert::success('Success', 'User updated successfully');
            return redirect()->route('user-emp.view');

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

}









