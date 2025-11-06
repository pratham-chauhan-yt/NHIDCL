<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\UserNotificationController;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DepartmentMaster;
use App\Models\DesignationMaster;
use App\Models\RecruitmentEmpJoiningApplicationDetails;

class EmployeeJoiningApplicationController extends Controller
{

    protected $userNotificationController;

    public function __construct(UserNotificationController $userNotificationController)
    {
        $this->userNotificationController = $userNotificationController;

    }

    public function employeeJoiningApplication(Request $request)
    {
        try {
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $designation = DesignationMaster::orderBy('name', 'asc')->get();
            $state = DB::table('state_master')->orderBy('name', 'asc')->get();
            $office_type = DB::table('category_master')->orderBy('name', 'asc')->get();
            $header = true;
            $sidebar = true;
            return view('recruitment.employeeJoiningApplication', compact('header', 'sidebar','department','designation','state','office_type'));

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later..');
            return redirect()->back();
        }
    }

    public function empApplicationFormStore(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'mobile_number' => 'required',
                'email_address' => 'required|string|email|max:255|unique:users,email',
            ],
            [
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'mobile_number.required' => 'Mobile no is required',
                'email_address.required' => 'Email is required',
            ]);

            $EmployeeDetails = array();

            $EmployeeDetails["first_name"] = $request->first_name;
            $EmployeeDetails["last_name"] =  $request->last_name;
            $EmployeeDetails["date_of_birth"] = $request->date_of_birth;
            $EmployeeDetails["address"] = $request->address;
            $EmployeeDetails["employment_type"] = $request->employment_type;
            $EmployeeDetails["mobile_number"]  = $request->mobile_number;
            $EmployeeDetails["assigned_job_position"] = $request->assigned_job_position;
            $EmployeeDetails["kras"]= $request->kras;
            $EmployeeDetails["employee_policies"] = $request->employee_policies;
            $EmployeeDetails["gender"]= $request->gender;
            $EmployeeDetails["nationality"] = $request->nationality;
            $EmployeeDetails["marital_status"] = $request->marital_status;
            $EmployeeDetails["email_address"] =  $request->email_address;
            $EmployeeDetails["residential_address"] = $request->residential_address;
            $EmployeeDetails["current_designation"] = $request->current_designation;
            $EmployeeDetails["department"] = $request->department;
            $EmployeeDetails["joining_date"] = $request->joining_date;
            $EmployeeDetails["employment_status"] = $request->employment_status;
            $EmployeeDetails["job_role_description"] = $request->job_role_description;
    
            $save = RecruitmentEmpJoiningApplicationDetails::create($EmployeeDetails);

            if($save){
                    Alert::success('Success','Inserted Successfully');
                    // return redirect()->back();
                    return redirect()->route('recruitment.viewEmpJoiningApplication');
               }else{

                    Alert::error('error', 'Something went wrong');
                    return redirect()->back();
                }

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }


    public function viewEmpJoiningApplication(Request $request)
    {
        try
        {
            if($request->ajax())
            {
               $totalDataQry = RecruitmentEmpJoiningApplicationDetails::get();
            //   \DB::enableQueryLog();
             // $totalDataQry = RecruitmentEmpJoiningApplicationDetails::get();
             // /dd(\DB::getQueryLog());

                $final_data = $totalDataQry;
                $datatables =  DataTables::of($final_data);
                $datatables->addIndexColumn()
                ->addColumn('first_name', function ($row) {
                    return  $row->first_name.' '.$row->last_name;
                })
                ->addColumn('last_name', function ($row) {
                    return $row->last_name;
                })
                ->addColumn('employment_type', function ($row) {
                    return $row->employment_type;
                })
                ->addColumn('mobile_number', function ($row) {
                    return $row->mobile_number;
                })
                ->addColumn('email_address', function ($row) {
                    return $row->email_address;
                })
                ->addColumn('gender', function ($row) {
                    return $row->gender;
                })
                ->addColumn('current_designation', function ($row) {
                    return $row->current_designation;
                })

                ->addColumn('action', function ($row) {

                     $enc_id = Crypt::encrypt($row->id);

                     $btn_edit = '<a href="' .route('recruitment.editEmployeeDetails', $enc_id). '"><span><i class="fa fa-pencil text-muted fs-16 align-middle me-1" data-toggle="tooltip" title="Edit Employee Details"></i></span></a>';

                     $btn_view =  '<a href="' .route('recruitment.showEmployeeDetails', $enc_id). '"><i class="fa fa-eye align-bottom text-success" title="View"></a>';

                     return $btn_edit . ' ' . $btn_view;
                })
                ->rawColumns(['action']);

            return $datatables->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        return view('recruitment.viewEmpJoiningApplication', compact('header', 'sidebar'));

            } catch (Exception $e) {
                Log::error($e);
                Alert::error('Error', 'Something went wrong, Please try again');
                return redirect()->back();
            }

    }

    public function editEmployeeDetails($id){
        try {

            $decryptedId = Crypt::decrypt($id);
            $emplist = RecruitmentEmpJoiningApplicationDetails::find($decryptedId);
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $designation = DesignationMaster::orderBy('name', 'asc')->get();
           //$country = DB::table('ref_countries')->orderBy('country_name', 'asc')->get();
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('recruitment.editEmployeeDetails', compact('header', 'sidebar','department','designation','emplist','roles'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('recruitment.viewEmpJoiningApplication');
        }

    }

    public function updateEmployeeDetails(Request $request){
        try {
           $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required',
            'email_address' => 'required|string|email|max:255|unique:users,email',
        ],
        [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'mobile_number.required' => 'Mobile no is required',
            'email_address.required' => 'Email is required',
        ]);

            $id = $request->id;
            $UpdateEmployeeDetails = array();

            $UpdateEmployeeDetails["first_name"] = $request->first_name;
            $UpdateEmployeeDetails["last_name"] =  $request->last_name;
            $UpdateEmployeeDetails["date_of_birth"] = $request->date_of_birth;
            $UpdateEmployeeDetails["address"] = $request->address;
            $UpdateEmployeeDetails["employment_type"] = $request->employment_type;
            $UpdateEmployeeDetails["mobile_number"]  = $request->mobile_number;
            $UpdateEmployeeDetails["assigned_job_position"] = $request->assigned_job_position;
            $UpdateEmployeeDetails["kras"]= $request->kras;
            $UpdateEmployeeDetails["employee_policies"] = $request->employee_policies;
            $UpdateEmployeeDetails["gender"]= $request->gender;
            $UpdateEmployeeDetails["nationality"] = $request->nationality;
            $UpdateEmployeeDetails["marital_status"] = $request->marital_status;
            $UpdateEmployeeDetails["email_address"] =  $request->email_address;
            $UpdateEmployeeDetails["residential_address"] = $request->residential_address;
            $UpdateEmployeeDetails["current_designation"] = $request->current_designation;
            $UpdateEmployeeDetails["department"] = $request->department;
            $UpdateEmployeeDetails["joining_date"] = $request->joining_date;
            $UpdateEmployeeDetails["employment_status"] = $request->employment_status;
            $UpdateEmployeeDetails["job_role_description"] = $request->job_role_description;
            $UpdateEmployeeDetails["created_at"] = now();
            
            $empUser = RecruitmentEmpJoiningApplicationDetails::where('id',$id)->update($UpdateEmployeeDetails);
   
               Alert::success('Success', 'Employee details updated successfully');
               return redirect()->route('recruitment.viewEmpJoiningApplication');
   
           } catch (\Exception $e) {
               Alert::error('Error', 'Oops, something went wrong. Please try again later.');
               return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
           }
       }

    public function showEmployeeDetails($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $emplist = RecruitmentEmpJoiningApplicationDetails::find($decryptedId);
            $department = DepartmentMaster::orderBy('name', 'asc')->get();

            $designation = DesignationMaster::orderBy('name', 'asc')->get();
            //$country = DB::table('ref_countries')->orderBy('country_name', 'asc')->get();
            $office_type = DB::table('category_master')->orderBy('name', 'asc')->get();
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('recruitment.showEmployeeDetails', compact('header', 'sidebar','department','designation','emplist','roles'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('recruitment.viewEmpJoiningApplication');
        }
    }

}
