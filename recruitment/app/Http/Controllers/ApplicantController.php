<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\UserNotificationController;
use App\Models\RefAreaExperties;
use App\Models\RefCourseMode;
use App\Models\RefExam;
use App\Models\RefJobType;
use App\Models\RefPostHeld;
use App\Models\RefQualification;
use App\Models\RefWorkExperienceYear;
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
use App\Http\Requests\candidate\personalDetailsRequest;
use App\Models\RefApplicantPersonalDetails;
use App\Models\NhidclAplicantEducationDetails;
use App\Models\NhidclApplicantWorkExperienceDetails;
use App\Models\NhidclApplicantAdditionalDetails;
use App\Helper\storeMedia;
use App\Models\NhidclResourceRequisition;
use App\Models\RefCourse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;




class ApplicantController extends Controller
{
    public function __construct()
    {

    }


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
            return view('applicant.add_register', compact('header', 'sidebar', 'department', 'designation', 'state', 'office_type', 'roles'));

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later..');
            return redirect()->back();
        }
    }

    /** temprary */
    public function applicantProfile()
    {
        $header = true;
        $sidebar = true;

        $courses = RefCourse::orderBy('id', 'asc')->get();
        $courseModes = RefCourseMode::orderBy('id', 'asc')->get();
        $qualifications = RefQualification::orderBy('id', 'asc')->get();
        $exams = RefExam::orderBy('id', 'asc')->get();
        $areaExperties = RefAreaExperties::orderBy('id', 'asc')->get();
        $jobTypes = RefJobType::orderBy('id', 'asc')->get();
        $posts = RefPostHeld::orderBy('id', 'asc')->get();
        $experienceYears = RefWorkExperienceYear::orderBy('id', 'asc')->get();

        $requisitionYears = NhidclResourceRequisition::selectRaw('EXTRACT(YEAR FROM created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $listOfRequisitions = [];

        if ($requisitionYears->isNotEmpty()) {
            $listOfRequisitions = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
                ->select('id', 'job_title')
                ->orderBy('id', 'asc')
                ->get();
        }

        $user = Auth::user();
        // $user_member = User::role('INTERNAL COMMITTEE-MEMBER')->get();
        $user_member = User::where(function ($query) {
            $query->whereHas('permissions', function ($subQuery) {
                $subQuery->where('name', 'resource pool - create committee shortlist');
            })
            ->orWhereHas('roles.permissions', function ($subQuery) {
                $subQuery->where('name', 'resource pool - create committee shortlist');
            });
        })
        ->where('is_nhidcl_employee', true)
        ->get();

        if (auth()->user()->hasRole('HR Resource Pool')) {
            return view("resource-pool.HR.selection-process", compact("header", "sidebar", "user_member", "courses", "courseModes", "qualifications", "exams", "areaExperties", "jobTypes", "posts", "experienceYears", "requisitionYears", "listOfRequisitions"));
        }

        return view("resource-pool.HR.CandidateUserData", compact("header", "sidebar"));

    }



    public function candidateAdvertisement()
    {
        $header = true;
        $sidebar = true;
        return view("candidate.advertisement", compact("header", "sidebar"));
    }

    public function personalDetails(Request $request)
    {
        try {
            // Validation rules
            $validation = Validator::make($request->all(), [
                "full_name" => 'required',
                "father_husband_name" => 'required',
                "email" => 'required|email|unique:ref_applicant_personal_details',
                "mobile_no" => 'required|numeric|digits:10|unique:ref_applicant_personal_details', // Corrected mobile number validation
                "date_of_birth" => 'required|date', // Added date validation
                "gender" => 'required',
                "correspondence_address" => 'required',
                "permanent_address" => 'required',
                "upload_photos" => 'required|image|mimes:jpeg,png,jpg,gif', // Assuming upload_photos is an image
                "upload_signature" => 'required|image|mimes:jpeg,png,jpg,gif',
                "upload_resume" => 'required|mimes:pdf,doc,docx',
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput($request->all()); // Use withErrors and withInput for input retention
            }

            // Prepare the data to save
            $dataArr = $request->only([
                "full_name",
                "father_husband_name",
                "mobile_no",
                "email",
                "gender",
                "date_of_birth",
                "correspondence_address",
                "permanent_address",
            ]);
            $dataArr['upload_photos'] = $request->upload_photoss;
            $dataArr['upload_signature'] = $request->upload_signaturee;
            $dataArr['upload_resume'] = $request->upload_resumee;
            // Add created_at timestamp
            $dataArr['created_at'] = now();
            $dataArr['ref_users_id'] = Auth::user()->id;


            // Save the data
            $save = RefApplicantPersonalDetails::where(["email" => $request->email, 'mobile_no' => $request->mobile_no])->first();
            if (!$save) {
                $save = RefApplicantPersonalDetails::create($dataArr);
            }


            // Check if the save was successful
            if ($save) {
                Alert::success('Success', 'Inserted Successfully');
                return redirect()->back()->with('tab', 1);
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->back();
            }

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function educationalDetails(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                "qualification.*" => 'required|string',
                "course.*" => 'required|string',
                "board_university_collage.*" => 'required|string',
                "main_subject.*" => 'required|string',
                "course_mode.*" => 'required|string',
                "passing_year.*" => array('required', 'date_format:"Y"', 'before:' . now()),
                "cgpa.*" => 'required|numeric',
                "percentage.*" => 'required',
                'marksheet_degree.*' => 'mimes:jpeg,png,jpg,gif,pdf,doc,docx',

            ]);

            // dd($request->all());
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }


            if (count($request->qualification)) {
                foreach ($request->qualification as $key => $val) {

                    $dataArr[$key]["qualification"] = $request->qualification[$key];
                    $dataArr[$key]["course"] = $request->course[$key];
                    $dataArr[$key]["board_university_collage"] = $request->board_university_collage[$key];
                    $dataArr[$key]["main_subject"] = $request->main_subject[$key];
                    $dataArr[$key]["course_mode"] = $request->course_mode[$key];
                    $dataArr[$key]["passing_year"] = $request->passing_year[$key];
                    $dataArr[$key]["cgpa"] = $request->cgpa[$key];
                    $dataArr[$key]["percentage"] = $request->percentage[$key];
                    $dataArr[$key]["marksheet_degree"] = $request->marksheet_degreee[$key];
                    $dataArr[$key]['ref_users_id'] = Auth::user()->id;
                    $dataArr[$key]['created_at'] = now();
                }
            }


            if (count($dataArr)) {
                foreach ($dataArr as $value) {
                    $save = NhidclAplicantEducationDetails::create($value);
                }
            }

            if ($save) {
                Alert::success('Success', 'Inserted Successfully');
                return redirect()->back()->with('tab', 2);
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function workExperienceDetails(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                "employer_name.*" => 'required',
                "post_held.*" => 'required',
                'from_date.*' => [
                    'required',
                    'before_or_equal:' . now()->format('d-m-Y'),
                ],
                'to_date.*' => [
                    'required',
                    'before_or_equal:' . now()->format('d-m-Y'),
                ],
                "nature_of_duties.*" => 'required',
                "employer_details.*" => 'required',
                "job_type.*" => 'required',
                "experience_certificate.*" => 'required|mimes:pdf,doc,docx',
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput(); // Use withErrors and withInput for input retention
            }

            //dd($request->experience_certificatee);
            if (count($request->employer_name)) {
                foreach ($request->employer_name as $key => $value) {
                    $dataArr[$key]["employer_name"] = $request->employer_name[$key];
                    $dataArr[$key]["post_held"] = $request->post_held[$key];
                    $dataArr[$key]["from_date"] = $request->from_date[$key];
                    $dataArr[$key]["to_date"] = $request->to_date[$key];
                    $dataArr[$key]["post_held"] = $request->post_held[$key];
                    $dataArr[$key]["nature_of_duties"] = $request->nature_of_duties[$key];
                    $dataArr[$key]["employer_details"] = $request->employer_details[$key];
                    $dataArr[$key]["job_type"] = $request->job_type[$key];
                    $dataArr[$key]['experience_certificate'] = $request->experience_certificatee[$key];
                    $dataArr[$key]['created_at'] = now();
                    $dataArr[$key]['ref_users_id'] = Auth::user()->id;

                }
            }

            if (count($dataArr)) {
                foreach ($dataArr as $value) {
                    $save = NhidclApplicantWorkExperienceDetails::create($value);
                }
            }
            if ($save) {
                Alert::success('Success', 'Inserted Successfully');
                return redirect()->back()->with('tab', 3);
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function additionalDetails(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                "award_name.*" => 'required',
                "award_details.*" => 'required',
                "award_certificate.*" => 'required|mimes:pdf,doc,docx',
                //"achievements.*" => 'required|mimes:pdf,doc,docx',
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                //dd($validation);
                return redirect()->back()->withErrors($validation)->withInput(); // Use withErrors and withInput for input retention
            }
            // dd($request->all());
            if (count($request->award_name)) {
                foreach ($request->award_name as $key => $value) {
                    $dataArr[$key]["award_name"] = $request->award_name[$key];
                    $dataArr[$key]["award_details"] = $request->award_details[$key];
                    $dataArr[$key]["award_certificate"] = $request->award_certificatee[$key];
                    //$dataArr[$key]["achievements"]=$request->achievementss[$key];
                    $dataArr[$key]['created_at'] = now();
                    $dataArr[$key]['ref_users_id'] = Auth::user()->id;

                }
            }
            // dd( $dataArr);
            if (count($dataArr)) {
                foreach ($dataArr as $value) {
                    $save = NhidclApplicantAdditionalDetails::create($value);
                }
            }


            if ($save) {
                Alert::success('Success', 'Inserted Successfully');
                return redirect()->back()->with('tab', 4);
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    public function storeUpload_cover_photo(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_resume')) {
                    return storeMedia($request, 'uploads/candidate/resume/', $ext, 'upload_resume');
                }
                if ($request->hasFile('upload_signature')) {
                    //dd($request->all());
                    return storeMedia($request, 'uploads/candidate/signature/', $ext, 'upload_signature');
                }
                if ($request->hasFile('upload_photos')) {
                    return storeMedia($request, 'uploads/candidate/photos/', $ext, 'upload_photos');
                }

                if ($request->hasFile('marksheet_degree')) {
                    return storeMedia($request, 'uploads/candidate/marksheet_degree/', $ext, 'marksheet_degree');
                }

                if ($request->hasFile('experience_certificate')) {
                    return storeMedia($request, 'uploads/candidate/experience_certificate/', $ext, 'experience_certificate');
                }
                if ($request->hasFile('award_certificate')) {
                    return storeMedia($request, 'uploads/candidate/award_certificate/', $ext, 'award_certificate');
                }
                if ($request->hasFile('achievements')) {
                    return storeMedia($request, 'uploads/candidate/achievements/', $ext, 'achievements');
                }

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Request'
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Invalid Request'
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function viewFiles(Request $request)
    {
        $pathName = $request->pathName;
        $fileName = $request->fileName;

        $file = viewFilePath($pathName) . urldecode($fileName);
        // dd($file);
        // dd($_SERVER['DOCUMENT_ROOT']);
        if (file_exists($file)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: inline; filename=" . basename($file));
            header("Content-Type: " . mime_content_type($file));
            header("Content-Length: " . filesize($file));
            header("Content-Transfer-Encoding: binary");
            readfile($file);
            exit;
        } else {
            return redirect()->back();
        }
    }

    public function candidate_details(Request $request, $id = null)
    {
        if (isset($id)) {
            Auth::user()->id = $id;
            // dd('hhhhhhh');
        }


        $tab_id = str_replace("defaultOpen", "", $request->tab_id);
        $Data['tab_id'] = $tab_id;
        if ($tab_id == "1") {
            $Data['data'] = RefApplicantPersonalDetails::where("ref_users_id", Auth::user()->id)->first();
        }
        if ($tab_id == "2") {
            $Data['data'] = NhidclAplicantEducationDetails::where("ref_users_id", Auth::user()->id)->get();
        }
        if ($tab_id == "3") {
            $Data['data'] = NhidclApplicantWorkExperienceDetails::where("ref_users_id", Auth::user()->id)->get();
        }
        if ($tab_id == "4") {
            $Data['data'] = NhidclApplicantAdditionalDetails::where("ref_users_id", Auth::user()->id)->get();
        }
        if ($tab_id == "5") {
            $Data['personal_details'] = RefApplicantPersonalDetails::where("ref_users_id", Auth::user()->id)->first();
            $Data['educational_details'] = NhidclAplicantEducationDetails::where("ref_users_id", Auth::user()->id)->get();
            $Data['experience_details'] = NhidclApplicantWorkExperienceDetails::where("ref_users_id", Auth::user()->id)->get();
            $Data['additional_details'] = NhidclApplicantAdditionalDetails::where("ref_users_id", Auth::user()->id)->get();
        }

        return response()->json($Data, 200);
    }

    public function delete_candidate(Request $request)
    {
        if ($request->tab_id == 2) {
            $data = NhidclAplicantEducationDetails::find($request->id);
            if ($data->delete()) {
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->back();
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->back();
            }
        }
        if ($request->tab_id == 3) {
            $data = NhidclApplicantWorkExperienceDetails::find($request->id);
            if ($data->delete()) {
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->back();
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->back();
            }
        }
        if ($request->tab_id == 4) {

            $data = NhidclApplicantAdditionalDetails::find($request->id);
            if ($data->delete()) {
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->back();
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->back();
            }
        }
    }

    public function advertisment(Request $request)
    {
        try {
            $data = NhidclResourceRequisition::where("duration_of_engagement_end", ">", today()->format('Y-m-d'))
                ->get();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function advertismentArchive(Request $request)
    {
        try {
            $date = today()->format('Y-m-d');
            $data = NhidclResourceRequisition::with("creator")->get();
            return response()->json($data, 200);

            // $posts = NhidclResourceRequisition::with("creator")->select('id','job_title','job_description','duration_of_engagement_start','duration_of_engagement_end','created_at','created_by')->paginate(2);

            // $paginationLinks = (string) $posts->links();
            // return response()->json([
            //     'posts'  =>$posts,
            //     'pagination' => $paginationLinks
            // ]);


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

}
