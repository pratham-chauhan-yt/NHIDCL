<?php

namespace App\Http\Controllers\Recruitment;

use App\Models\RecruitmentPersonDetail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class BasicDetailsController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function BasicDetail()
    {
        $header = true;
        $sidebar = true;
        return view("recruitment.basicDetails", compact("header", "sidebar"));
    }

    public function basicDetailsStore(Request $request){
        try
        {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'mobile_no' => 'required',
                'email_id' => 'required|string|email|max:255|unique:users,email',
                'date_of_birth' => 'required',
                'address' => 'required',
                'nationality' => 'required',
                'marital_status' => 'required',
                'applied_for' => 'required',
                'expected_salary' => 'required',
                'work_experience' => 'required',
                'educational' => 'required',
                'reference' => 'required',
                'upload_cv_portfolio_links' => 'required',
            ],
            [
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'mobile_no.required' => 'Mobile no is required',
                'email_id.required' => 'Email is required',
                'date_of_birth.required' => 'Date of birth is required',
                'address.required' => 'Address is required',
                'nationality.required' => 'Nationality is required',
                'marital_status.required' => 'Merital Status is required',
                'applied_for.required' => 'Applied for is required',
                'expected_salary.required' => 'Expected Salary is required',
                'work_experience.required' => 'Work Experiance is required',
                'educational.required' => 'Educational Background is required',
                'reference.required' => 'Reference Details is required',
                'upload_cv_portfolio_links.required' => 'Upload Cv is required',
            ]);

                $dataArr = array();
                $dataArr["first_name"] = $request->first_name;
                $dataArr["last_name"] = $request->last_name;
                $dataArr["mobile_no"] = $request->mobile_no;
                $dataArr["email_id"] = $request->email_id;
                $dataArr["date_of_birth"] = $request->date_of_birth;
                $dataArr["address"] = $request->address;
                $dataArr["nationality"] = $request->nationality;
                $dataArr["marital_status"] = $request->marital_status;
                $dataArr["applied_for"] = $request->applied_for;
                $dataArr["expected_salary"] = $request->expected_salary;
               // $dataArr["work_experience"] = $request->work_experience;
                $dataArr["educational"] = $request->educational;
                $dataArr["reference"] = $request->reference;
               // $dataArr["upload_cv_portfolio_links"] = $request->upload_cv_portfolio_links;
                $dataArr['created_at'] = date('Y-m-d');

               $save = RecruitmentPersonDetail::create($dataArr);

               if($save){
                    Alert::success('Success','Inserted Successfully');
                    return redirect()->back();
                    //return redirect()->route('recruitment.viewBasicDetails');
               }else{

                    Alert::error('error', 'Something went wrong');
                    return redirect()->back();
                }

        }catch (Exception $e)
            {
                Log::error($e->getMessage());
                $msg = $e->getMessage();
                return back()->with('error', $msg);
            }
        }

    /**
     * Display the specified resource.
     */
    public function viewBasicDetails(Request $request)
    {
        // If the request is an AJAX call for DataTables
        if ($request->ajax()) {
            
                $candidateDetails = RecruitmentPersonDetail::where('first_name', '!=', '')->orderBy('first_name', 'asc')->get();

                $final_data = $candidateDetails;
                $datatables =  DataTables::of($final_data);
                $datatables->addIndexColumn()
                ->addColumn('first_name', function ($row) {
                    return  $row->first_name;
                })
                ->addColumn('last_name', function ($row) {
                    return $row->last_name;
                })
                ->addColumn('mobile_no', function ($row) {
                    return $row->mobile_no;
                })
                ->addColumn('email_id', function ($row) {
                    return $row->email_id;
                })
                ->addColumn('address', function ($row) {
                    return $row->address;
                })
                ->addColumn('nationality', function ($row) {
                    return $row->nationality;
                })
                ->addColumn('applied_for', function ($row) {
                    return $row->applied_for;
                })
                ->addColumn('action', function ($row) {

                     $enc_id = Crypt::encrypt($row->id);

                     $btn_edit = '<a href="' .route('recruitment.viewBasicDetails', $enc_id). '"><span><i class="fa fa-pencil text-muted fs-16 align-middle me-1" data-toggle="tooltip" title="Edit Employee Details"></i></span></a>';

                     $btn_view =  '<a href="' .route('recruitment.showBasicDetails', $enc_id). '"><i class="fa fa-eye align-bottom text-success" title="View"></a>';

                     //$btn_delete =  '<a href="' .route('recruitment.deleteAdvertisement', $enc_id). '"><i class="fa fa-trash align-bottom text-danger" title="Delete"></a>';

                     return $btn_edit . ' ' . $btn_view;
                })
                ->rawColumns(['action']);

            return $datatables->make(true);

        }

        // Render the view with the DataTables setup
        $header = TRUE;
        $sidebar = TRUE;
        return view('recruitment.viewBasicDetails', compact('header', 'sidebar'));
    }
    
     /**
     * Display the specified resource.
     */
    public function showBasicDetails($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $CandidateList = RecruitmentPersonDetail::find($decryptedId);
            $roles = Role::where('name', 'not like', '%Admin%')->get();
            $header = true;
            $sidebar = true;
            return view('recruitment.showBasicDetails', compact('header', 'sidebar','CandidateList','roles'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('recruitment.viewBasicDetails');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = RecruitmentPersonDetail::find(Crypt::decrypt($id));
           // $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name', 'asc')->get();
            $hasRoles = $user->roles->pluck('id');
            $header = TRUE;
            $sidebar = TRUE;

            return view('recruitment.edit', compact('user', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid user ID provided.');
            return redirect()->route('recruitment.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $candidateDetails = RecruitmentPersonDetail::find(Crypt::decrypt($id));
            if (!$candidateDetails) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->back()->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            $candidateDetails->delete();
            Alert::success('Success', 'Data deleted successfully');
            return redirect()->route('recruitment.viewBasicDetails')->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
