<?php

namespace App\Http\Controllers\ResourcePool\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\UserNotificationController;
use App\Models\RefEngagement;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\RefExam;
use App\Models\NhidclCompetitiveExams;
use PDF;
use App\Helper\ResourcePool\calculateRoundedYearDifference;
use App\Helper\ResourcePool\extractFileDetails;
use App\Helper\checkFileExist;
use App\Http\Requests\Candidate\AdditionalDetailRequest;
use App\Http\Requests\Candidate\CompetitiveDetailRequest;
use App\Http\Requests\Candidate\EducationalDetailRequest;
use App\Http\Requests\Candidate\PersonalDetailRequest;
use App\Http\Requests\Candidate\WorkExperienceDetailRequest;
use App\Mail\DisclouserMail;
use App\Models\RefQualification;
use App\Models\RefCourse;
use App\Models\RefBoardUniversityCollege;
use App\Models\RefMainSubject;
use App\Models\RefCourseMode;
use App\Models\RefPassingYear;
use App\Models\RefPostHeld;
use App\Models\RefAreaExperties;
use App\Models\RefJobType;
use App\Models\RefConductingAgency;
use App\Models\NhidclTrainingCertificate;
use App\Models\NhidclDisclouserQuestions;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class ApplicantCandidateController extends Controller
{
    public function __construct() {}


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
            return redirect()->route('candidate.applicantProfile');
        }
    }


    public function applicantProfile()
    {
        $header = true;
        $sidebar = true;
        $user = Auth::user();
        $exams = RefExam::get();

        $userId = $user->id;
        $previewData = RefApplicantPersonalDetails::with('engagementType')->where(["ref_users_id" => $userId])->first();

        $sections = [
            'ref_applicant_personal_details' => DB::table('ref_applicant_personal_details')->where('ref_users_id', $userId)->exists(),
            'nhidcl_applicant_education_details' => DB::table('nhidcl_applicant_education_details')->where('ref_users_id', $userId)->exists(),
            'nhidcl_applicant_work_experience_details' => DB::table('nhidcl_applicant_work_experience_details')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_applicant_additional_details' => DB::table('nhidcl_applicant_additional_details')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_competitive_exams' => DB::table('nhidcl_competitive_exams')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_training_certificate' => DB::table('nhidcl_training_certificate')->where('ref_users_id', $userId)->exists(),
            'nhidcl_disclouser_questions' => DB::table('nhidcl_training_certificate')->where('ref_users_id', $userId)->exists()
        ];

        $filled = array_filter($sections);
        $totalSections = count($sections);
        $completed = count($filled);
        $percentage = ($completed / $totalSections) * 100;

        $board_university_collages = RefBoardUniversityCollege::get();
        $main_subjects = RefMainSubject::get();
        $course_modes = RefCourseMode::get();
        $passing_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
        $post_helds = RefPostHeld::get();
        $engagements = RefEngagement::get();
        $area_experties = RefAreaExperties::get();
        $job_types = RefJobType::get();
        $conductingAgency = RefConductingAgency::get();

        $qualifications = RefQualification::select('id', 'qualification_name')->get();
        $courses = RefCourse::select('id', 'course_name', "ref_qualification_id")->get();


        $clsStatus = NhidclDisclouserQuestions::ofUser(user_id())->first();

        $btnApplication = "Save";

        if ($clsStatus) {
            $btnApplication = $clsStatus->draft_or_submit === "drafted" ? "Save" : "Update";
        }
        $requiredTables = [
            'ref_applicant_personal_details',
            'nhidcl_applicant_education_details',
            'nhidcl_applicant_work_experience_details',
            // 'nhidcl_applicant_additional_details',
            // 'nhidcl_competitive_exams',
            // 'nhidcl_training_certificate',
            'nhidcl_disclouser_questions', // update this
        ];
        $isProfileComplete = true;
        foreach ($requiredTables as $table) {
            if (!DB::table($table)->where('ref_users_id', $userId)->exists()) {
                $isProfileComplete = false;
            }
        }
        return view("resource-pool.Candidate.applicantCandidateProfile", compact("header", "sidebar", "conductingAgency", "job_types", "area_experties", "post_helds", "engagements", "passing_years", "course_modes", "main_subjects", "board_university_collages", "exams", 'qualifications', 'courses', 'btnApplication', 'percentage', 'sections', 'completed', 'totalSections', 'isProfileComplete', 'previewData'));
    }



    public function candidateAdvertisement()
    {
        $header = true;
        $sidebar = true;
        return view("resource-pool.Candidate.advertisement", compact("header", "sidebar"));
    }

    public function personalDetails(PersonalDetailRequest $request)
    {
        try {

            $validated = $request->validated();
            $dataArr = $request->only([
                "ref_engagement_id",
                "full_name",
                "father_husband_name",
                "mobile_no",
                "email",
                "gender",
                "date_of_birth",
                "pincode",
                "correspondence_address",
                "permanent_address",
                "spouse_name",
                "spouse_mobile_no",
            ]);
            $photos = extractFileDetails($request->upload_photoss);

            $dataArr['upload_photos'] = @$photos["fileName"];
            $dataArr['upload_photos_filepath'] = @$photos["filePath"];
            //dd($dataArr,$request->all());
            $signature = extractFileDetails($request->upload_signaturee);
            $dataArr['upload_signature'] = $signature["fileName"];
            $dataArr['upload_signature_filepath'] = $signature["filePath"];

            $resume = extractFileDetails($request->upload_resumee);

            $dataArr['upload_resume'] = $resume["fileName"];
            $dataArr['upload_resume_filepath'] = $resume["filePath"];

            // Add created_at timestamp
            $dataArr['created_at'] = now();
            $dataArr['ref_users_id'] = Auth::user()->id;



            // Save the data
            $save = RefApplicantPersonalDetails::where(["email" => $request->email, 'mobile_no' => $request->mobile_no])->first();
            if (!$save) {
                $save = RefApplicantPersonalDetails::create($dataArr);
            } else {
                $save = RefApplicantPersonalDetails::where('id', $save->id)->update($dataArr);
            }


            // Check if the save was successful
            if ($save) {
                Alert::success('Success', 'Personal Details Added Successfully');
                return redirect()->route('candidate.applicantProfile')->with('tab', 1);
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
        }
    }

    public function educationalDetails(EducationalDetailRequest $request)
    {
        try {

            $validated = $request->validated();
            if(!empty($request->marksheet_degreee)){
                $marksheet = extractFileDetails($request->marksheet_degreee);
                $dataArr['marksheet_degree'] = @$marksheet["fileName"];
                $dataArr['marksheet_degree_filepath'] = @$marksheet["filePath"];
            }
            $dataArr["ref_qualification_id"] = $request->qualification;
            $dataArr["other_qualification"] = $request->other_qualification ? $request->other_qualification : NULL;
            $dataArr["ref_course_id"] = @$request->course;
            $dataArr["other_course"] = $request->other_course ? $request->other_course : NULL;
            $dataArr["ref_board_university_college_id"] = $request->board_university_collage;
            $dataArr["other_board_university_collage"] = $request->other_board_university_collage ? $request->other_board_university_collage : NULL;
            $dataArr["ref_main_subject_id"] = $request->main_subject == 'Others' ? NULL : $request->main_subject;
            $dataArr["other_main_subject"] = $request->other_main_subject ? $request->other_main_subject : NULL;
            $dataArr["ref_course_mode_id"] = $request->course_mode;
            $dataArr["passing_year"] = $request->passing_year;
            $dataArr["cgpa"] = $request->cgpa;
            $dataArr["percentage"] = $request->percentage;
            //$dataArr["marksheet_degree"] = $request->marksheet_degreee;
            $dataArr['ref_users_id'] = Auth::user()->id;
            $dataArr['created_at'] = now();

            $save = NhidclAplicantEducationDetails::create($dataArr);

            if ($save) {

                Alert::success('Success', 'Education Details added Successfully');
                if ($request->eduClickedFrom == "educationalDetailsBtn1") {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 2);
                } else {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 1);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
        }
    }

    public function workExperienceDetails(WorkExperienceDetailRequest $request)
    {
        try {

            $validated = $request->validated();

            if (count($request->employer_name)) {
                foreach ($request->employer_name as $key => $value) {
                    $expCertificate = extractFileDetails($request->experience_certificatee[$key]);

                    $dataArr[$key]['experience_certificate'] = @$expCertificate["fileName"];
                    $dataArr[$key]['experience_certificate_filepath'] = @$expCertificate["filePath"];
                    $dataArr[$key]["employer_name"] = $request->employer_name[$key];
                    $dataArr[$key]["post_held"] = @$request->post_held[$key];
                    $dataArr[$key]["from_date"] = $request->from_date[$key];
                    $dataArr[$key]["to_date"] = $request->to_date[$key];
                    // $dataArr[$key]["ref_post_held_id"]=$request->post_held[$key];
                    $dataArr[$key]["nature_of_duties"] = $request->nature_of_duties[$key];
                    $dataArr[$key]["employer_details"] = @$request->employer_details[$key];
                    $dataArr[$key]["ref_job_type_id"] = $request->job_type[$key];
                    //$dataArr[$key]['experience_certificate'] = $request->experience_certificatee[$key];
                    $dataArr[$key]['created_at'] = now();
                    $dataArr[$key]['ref_users_id'] = Auth::user()->id;
                    $dataArr[$key]['ref_area_experties_id'] = $request->area_of_expertise[$key] == 'Others' ? NULL : $request->area_of_expertise[$key];
                    $dataArr[$key]['other_area_of_expertise'] = $request->other_area_of_expertise[$key] ? $request->other_area_of_expertise[$key] : NULL;
                    // $dataArr[$key]['ref_area_experties_id'] = trim($request->area_of_expertise[$key],",");
                    $dataArr[$key]['ref_work_experience_year_id'] = calculateRoundedYearDifference($request->from_date[$key], $request->to_date[$key]);
                }
            }
            // dd($dataArr);
            if (count($dataArr)) {
                foreach ($dataArr as $value) {
                    $save = NhidclApplicantWorkExperienceDetails::insert($dataArr);
                }
            }


            if ($save) {
                Alert::success('Success', 'Work Experience added successfully');

                if ($request->workClickedFrom == "workExperienceDetailsBtn") {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 3);
                } else {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 2);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
        }
    }

    public function additionalDetails(AdditionalDetailRequest $request)
    {
        try {

            $validated = $request->validated();

            if (count($request->award_name)) {
                foreach ($request->award_name as $key => $value) {
                    $awardCertificate = extractFileDetails($request->award_certificatee[$key]);

                    $dataArr[$key]['award_certificate'] = @$awardCertificate["fileName"];
                    $dataArr[$key]['award_certificate_filepath'] = @$awardCertificate["filePath"];

                    $dataArr[$key]["award_name"] = $request->award_name[$key];
                    $dataArr[$key]["award_details"] = $request->award_details[$key];
                    // $dataArr[$key]["award_certificate"]=$request->award_certificatee[$key];
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
                Alert::success('Success', 'Additional Details Inserted Successfully');
                if ($request->addClickedFrom == "additionalDetailsBtn1") {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 4);
                } else {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 5);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
        }
    }

    public function competitiveDetails(CompetitiveDetailRequest $request)
    {
        try {

            $validated = $request->validated();

            if (count($request->name_of_exam)) {
                foreach ($request->name_of_exam as $key => $value) {
                    $Certificate = extractFileDetails($request->certificatee[$key]);

                    $dataArr[$key]['certificate'] = @$Certificate["fileName"];
                    $dataArr[$key]['certificate_filepath'] = @$Certificate["filePath"];

                    $dataArr[$key]["ref_exam_id"] = $request->name_of_exam[$key];
                    $dataArr[$key]["appearing_year"] = $request->appearing_year[$key];
                    $dataArr[$key]["score"] = $request->score[$key];
                    $dataArr[$key]["certificate"] = $request->certificatee[$key];
                    $dataArr[$key]['created_at'] = now();
                    $dataArr[$key]['ref_conducting_agency_id'] = $request->conducting_agency[$key];
                    $dataArr[$key]['ref_users_id'] = Auth::user()->id;
                }
            }
            $save = 0;
            if (count($dataArr)) {
                foreach ($dataArr as $val) {
                    try {
                        NhidclCompetitiveExams::create($val);
                        $save++;
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }
            }
            // dd($save);
            if ($save) {
                Alert::success('Success', ' Competitive Exam Inserted Successfully');
                if ($request->competClickedFrom == "competitiveBtn") {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 4);
                } else {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 3);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
        }
    }

    public function trainingDetails(Request $request)
    {
        try {
            //dd($request->all());

            $validation = Validator::make($request->all(), [
                "name_of_training" => 'required',
                "training_start_date" => 'required',
                "training_end_date" => 'required',
                "description" => 'required',
                // "certificate_expiry_date"=>"required",
                "training_certificate" => 'required|mimes:pdf',
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                return redirect()->route('training-details')->withErrors($validation)->withInput();
            }
            $Tcertificate = extractFileDetails($request->training_certificatee);

            //dd($Tcertificate);

            $dataArr = new NhidclTrainingCertificate;
            $dataArr->name_of_training = $request->name_of_training;
            $dataArr->training_start_date = $request->training_start_date;
            $dataArr->training_end_date = $request->training_end_date;
            $dataArr->description = $request->description;
            $dataArr->certificate_expiry_date = $request->certificate_expiry_date;
            //$dataArr->training_certificate = $request->training_certificatee;
            $dataArr->training_certificate = @$Tcertificate["fileName"];
            $dataArr->training_certificate_filepath = @$Tcertificate["filePath"];
            $dataArr->ref_users_id = Auth::user()->id;

            if ($dataArr->save()) {
                Alert::success('Success', 'Training Details Inserted Successfully');
                if ($request->trainClickedFrom == "trainingAddBtn") {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 5);
                } else {
                    return redirect()->route('candidate.applicantProfile')->with('tab', 6);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('candidate.applicantProfile')->with('error', $e->getMessage());
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
                if ($request->hasFile('training_certificate')) {
                    return storeMedia($request, 'uploads/candidate/training_certificate/', $ext, 'training_certificate');
                }
                if ($request->hasFile('certificate')) {
                    return storeMedia($request, 'uploads/candidate/certificate/', $ext, 'certificate');
                }
                if ($request->hasFile('conviction_file')) {
                    return storeMedia($request, 'uploads/candidate/conviction_file/', $ext, 'conviction_file');
                }
                if ($request->hasFile('criminal_case_file')) {
                    return storeMedia($request, 'uploads/candidate/criminal_case_file/', $ext, 'criminal_case_file');
                }
                if ($request->hasFile('financial_liabilities_file')) {
                    return storeMedia($request, 'uploads/candidate/financial_liabilities_file/', $ext, 'financial_liabilities_file');
                }
                if ($request->hasFile('conflict_of_interest_file')) {
                    return storeMedia($request, 'uploads/candidate/conflict_of_interest_file/', $ext, 'conflict_of_interest_file');
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
            return redirect()->route('viewFiles');
        }
    }

    public function candidate_details(Request $request)
    {
        $tab_id = str_replace("defaultOpen", "", $request->tab_id);
        $Data['tab_id'] = $tab_id;
        if ($tab_id == "1") {
            $Data['data'] = RefApplicantPersonalDetails::with('engagementType')->where("ref_users_id", Auth::user()->id)->first();
        }
        if ($tab_id == "2") {
            $Data['data'] = NhidclAplicantEducationDetails::with("ref_passing_year", "board_university_college", "main_subject", "course_mode", "qualification", "course")->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
        }
        if ($tab_id == "3") {
            $Data['data'] = NhidclApplicantWorkExperienceDetails::with("job_type", "area_experties")->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
        }
        if ($tab_id == "4") {
            $Data['data'] = NhidclCompetitiveExams::with('examDetails', 'appearingYear')->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
        }
        if ($tab_id == "5") {
            $Data['data'] = NhidclApplicantAdditionalDetails::where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
        }
        if ($tab_id == "6") {
            $Data['data'] = NhidclTrainingCertificate::where("ref_users_id", Auth::user()->id)->get();
        }
        if ($tab_id == "7") {
            $Data['personal_details'] = RefApplicantPersonalDetails::with('engagementType')->where("ref_users_id", Auth::user()->id)->first();
            $Data['educational_details'] = NhidclAplicantEducationDetails::with("ref_passing_year", "board_university_college", "main_subject", "course_mode", "qualification", "course")->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
            $Data['experience_details'] = NhidclApplicantWorkExperienceDetails::with("job_type", "area_experties")->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
            $Data['additional_details'] = NhidclApplicantAdditionalDetails::where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
            $Data['competitive_details'] = NhidclCompetitiveExams::with('examDetails', 'appearingYear')->where("ref_users_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();
            $Data['training_details'] = NhidclTrainingCertificate::where("ref_users_id", Auth::user()->id)->get();
            $Data['disclouser_questions'] = NhidclDisclouserQuestions::where("ref_users_id", Auth::user()->id)->first();
        }
        //dd($Data);
        return response()->json($Data, 200);
    }

    public function delete_candidate(Request $request)
    {
        if ($request->tab_id == 2) {
            $data = NhidclAplicantEducationDetails::find($request->id);

            if ($data->delete()) {
                $file = checkFileExist($data->marksheet_degree_filepath, $data->marksheet_degree);
                if ($file) unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('candidate.applicantProfile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        }
        if ($request->tab_id == 3) {
            $data = NhidclApplicantWorkExperienceDetails::find($request->id);

            if ($data->delete()) {
                $file = checkFileExist($data->experience_certificate_filepath, $data->experience_certificate);
                if ($file) unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('candidate.applicantProfile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        }
        if ($request->tab_id == 4) {

            $data = NhidclCompetitiveExams::find($request->id);

            if ($data->delete()) {
                $file = checkFileExist($data->certificate_filepath, $data->certificate);
                if ($file) unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('candidate.applicantProfile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        }
        if ($request->tab_id == 5) {

            $data = NhidclApplicantAdditionalDetails::find($request->id);
            if ($data->delete()) {
                $file = checkFileExist($data->award_certificate_filepath, $data->award_certificate);
                if ($file) unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('candidate.applicantProfile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        }

        if ($request->tab_id == 6) {

            $data = NhidclTrainingCertificate::find($request->id);
            if ($data->delete()) {
                $file = checkFileExist($data->training_certificate_filepath, $data->training_certificate);
                if ($file) unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('candidate.applicantProfile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('candidate.applicantProfile');
            }
        }
    }


    public function advertisment(Request $request)
    {
        try {
            //    dd($request->searchKey);
            $data = NhidclResourceRequisition::where("end_date", ">=", today()->format('Y-m-d'));

            if ($request->filled('searchKey')) {
                $search = $request->input('searchKey');
                $data = $data->whereRaw("job_title COLLATE utf8mb4_general_ci LIKE ?", ["%{$search}%"]);
            }


            $data = $data->get();

            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('candidate.advertisment')->with('error', $e->getMessage());
        }
    }

    public function advertismentArchive(Request $request)
    {
        try {

            $date = today()->format('Y-m-d');
            $data = NhidclResourceRequisition::with("creator")
                ->where('end_date', '<', today()->format('Y-m-d'));
            if ($request->input('searchKey')) {

                $data = $data->where("job_title", 'like', '%' . $request->searchKey . '%');
            }

            $data = $data->get();
            // dd($data);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('candidate.advertismentArchive')->with('error', $e->getMessage());
        }
    }

    public function profilePDF()
    {
        $user = User::findOrFail(Auth::id());

        $data = [
            'personal_details'     => RefApplicantPersonalDetails::with('engagementType')->where("ref_users_id", $user->id)->first(),
            'educational_details'  => NhidclAplicantEducationDetails::with(['ref_passing_year', 'board_university_college', 'main_subject', 'course_mode', 'qualification', 'course'])
                ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'experience_details'   => NhidclApplicantWorkExperienceDetails::with(['job_type', 'area_experties', 'work_experience'])
                ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'additional_details'   => NhidclApplicantAdditionalDetails::where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'competitive_details'  => NhidclCompetitiveExams::with(['examDetails', 'appearingYear'])
                ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'training_details'     => NhidclTrainingCertificate::where("ref_users_id", $user->id)->get(),
            'disclouser_questions' => NhidclDisclouserQuestions::where("ref_users_id", $user->id)->first(),
        ];

        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name) . '_' . time() . '.pdf';
        $userPhoto = ($data['personal_details'] && $data['personal_details']->upload_photos_filepath && $data['personal_details']->upload_photos) ? viewFilePath($data['personal_details']->upload_photos_filepath) . $data['personal_details']->upload_photos : "";
        $userSignature = ($data['personal_details'] && $data['personal_details']->upload_signature_filepath && $data['personal_details']->upload_signature) ? viewFilePath($data['personal_details']->upload_signature_filepath) . $data['personal_details']->upload_signature : "";
        $pdf = FacadePdf::loadView('resource-pool.pdfOfUserDetails', compact('data', 'user', 'userPhoto', 'userSignature'))
            ->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }


    public  function archiveDetails(Request $request)
    {

        $data = NhidclResourceRequisition::with("workExp")->find($request->add_id);
        return response()->json($data, 200);
    }

    public function finalClouser(Request $request)
    {
        $data = NhidclDisclouserQuestions::where("ref_users_id", Auth::user()->id)->first();
        if (!$data) {
            $data = new NhidclDisclouserQuestions;
        }

        $data->conviction = ($request->conviction == "Yes") ? true : false;
        $data->criminal_case = ($request->criminal_case == "Yes") ? true : false;
        $data->financial_liabilities = ($request->financial_liabilities == "Yes") ? true : false;
        $data->conflict_of_interest = ($request->conflict_of_interest == "Yes") ? true : false;
        $data->terms_agreement = ($request->terms_agreement == "on") ? true : false;
        $data->documentary_proof = ($request->documentary_proof == "on") ? true : false;
        $data->eligibility_criteria = ($request->eligibility_criteria == "on") ? true : false;
        $data->information_accuracy = ($request->information_accuracy == "on") ? true : false;
        $data->draft_or_submit = ($request->draftOrSubmit == "disclouserFinalBtn") ? "submitted" : "drafted";
        if ($request->conviction_filee) {
            $conviction = extractFileDetails($request->conviction_filee);
            $data->conviction_file = @$conviction["fileName"];
            $data->conviction_filepath = @$conviction["filePath"];
        }

        if ($request->criminal_case_filee) {
            $criminal_case_file = extractFileDetails($request->criminal_case_filee);
            $data->criminal_case_file = @$criminal_case_file["fileName"];
            $data->criminal_case_filepath = @$criminal_case_file["filePath"];
        }
        if ($request->financial_liabilities_filee) {
            $financial_liabilities_file = extractFileDetails($request->financial_liabilities_filee);
            $data->financial_liabilities_file = @$financial_liabilities_file["fileName"];
            $data->financial_liabilities_filepath = @$financial_liabilities_file["filePath"];
        }
        if ($request->conflict_of_interest_filee) {
            $conflict_of_interest_file = extractFileDetails($request->conflict_of_interest_filee);
            $data->conflict_of_interest_file = @$conflict_of_interest_file["fileName"];
            $data->conflict_of_interest_filepath = @$conflict_of_interest_file["filePath"];
        }

        $data->ref_users_id = user_id();
        if ($data->save()) {
            $message = ($request->draftOrSubmit == "disclouserFinalBtn") ? "Application submitted successfully" : "Drafted successfully";
            Alert::success('Success', $message);
            if ($request->draftOrSubmit == "disclouserFinalBtn") {
                $user = user();
                try {
                    Mail::to($user->email)->send(new DisclouserMail($user, $data->id));
                } catch (TransportExceptionInterface $e) {
                    Log::error("OTP mail send failed: " . $e->getMessage());
                    // Fallback logic: you can still continue if SMS was sent
                }
                
            }

            return redirect()->route('candidate.dashboard');
        } else {
            Alert::success('Error', 'Something went wrong');
            return redirect()->route('final-clouser.submition');
        }
    }

    public function testData(Request $request){
        if ($request->isMethod('post')) {
            // Handle form submission or AJAX
            return response()->json([
                'status' => true,
                'message' => 'Post request received',
                'data' => $request->summary
            ]);
        }

        // Handle initial GET request
        return view('profile.test_data', [
            'header' => true,
            'sidebar' => true,
        ]);
    }

    public function checkProfileComplete()
    {
        $userId = Auth::user()->id;
        $requiredTables = [
            'ref_applicant_personal_details',
            'nhidcl_applicant_education_details',
            'nhidcl_applicant_work_experience_details',
            // 'nhidcl_applicant_additional_details',
            // 'nhidcl_competitive_exams',
            // 'nhidcl_training_certificate',
            'final_submission_table',
        ];

        foreach ($requiredTables as $table) {
            if (!DB::table($table)->where('ref_users_id', $userId)->exists()) {
                return response()->json(['complete' => false]);
            }
        }
        return response()->json(['complete' => true]);
    }
}
