<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use App\Models\Recruitment\{Advertisement,AdvertisementPost,NhidclRecruitmentApplications,NhidclRecruitmentCandidateTimeline,NhidclRpGateScoreDetails, NhidclRPUpscExam, NhidclRecruitmentApplicationsLogs};
use App\Models\{RefState,User,RefCaste,RefModeOfRecruitment,RefApplicantPersonalDetails,RefGateDiscipline,RefPassingYear};
use App\Models\{NhidclAplicantEducationDetails,NhidclApplicantWorkExperienceDetails,NhidclApplicantAdditionalDetails};
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Recruitment\CandidateProfile\{NhidclRpApplicantPersonalDetails,NhidclRpEducationalQualification};
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\UserActivity;
use App\Http\Controllers\UserActivityController;
use App\Services\OtpService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

class CandidateController extends Controller
{   
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function index(Request $request)
    {
        $header = TRUE;
        $sidebar = TRUE;
        $userId = Auth::guard('web')->user()->id;

        $statusCounts = DB::table('ref_users as u')
        ->join('nhidcl_user_status as us', 'u.id', '=', 'us.ref_users_id')
        ->join('ref_interview_status as ris', 'us.ref_interview_status_id', '=', 'ris.id')
        ->select('ris.status', DB::raw('COUNT(*) as total'))
        ->whereIn('ris.status', ['SHORTLISTED', 'REJECTED', 'SELECTED', 'RESERVED'])
        ->groupBy('ris.status')
        ->pluck('total', 'status'); // This gives: ['SHORTLISTED' => 10, 'REJECTED' => 5, 'SELECTED' => 7]
        $ShortlestedUser = $statusCounts['SHORTLISTED'] ?? 0;
        $rejectedUser    = $statusCounts['REJECTED'] ?? 0;
        $selectedUser    = $statusCounts['SELECTED'] ?? 0;
        $ReservedUsers   = $statusCounts['RESERVED'] ?? 0;

        if ($request->ajax()) {
            $advertisementId = $request->input('advertisementId');

            // Process...
            if ($advertisementId) {
                $data = AdvertisementPost::where("nhidcl_recruitment_advertisement_id", $advertisementId)->get();
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid Advertisement ID'
            ]);
        }

        session(['moduleName' => 'Recruitment Portal']);
        $userQuery = User::where('is_deleted', '!=', '1')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'Recruitment User');
        });
        $users = $userQuery->where('module_name', 'Recruitment Portal')->orderBy('id', 'DESC')->get();
        $application = NhidclRecruitmentApplications::query()->where('action', 'submit')->get();
        $advertisement = Advertisement::whereNull('deleted_at')->count();
        $post = AdvertisementPost::whereNull('deleted_at')->count();
        $incompleteCount = NhidclRecruitmentApplications::query()->where('action', 'draft')->orWhereNull('action')->count();
        //$incompleteCount = NhidclRpApplicantPersonalDetails::query()
        $counts = Advertisement::select(
            DB::raw("CASE WHEN expiry_datetime >= NOW() THEN 'active' ELSE 'closed' END as status"),
            DB::raw("COUNT(*) as total")
        )
        ->whereNull('deleted_at')
        ->groupBy('status')
        ->pluck('total','status');
        // Add total count
        $counts['total'] = array_sum($counts->toArray());
        $distribution = NhidclRpApplicantPersonalDetails::with('caste')
        ->select('gender', 'ref_caste_id', DB::raw('COUNT(*) as total'))
        ->groupBy('gender', 'ref_caste_id')
        ->get()
        ->map(function($row) {
            return [
                'gender'   => $row->gender,
                'category' => $row->caste ? $row->caste->caste : null,
                'total'    => $row->total,
            ];
        });
        $listOfAdvertisement = Advertisement::where("expiry_datetime", ">=", today()->format('Y-m-d'))->orderBy('id', 'desc')->get();
        return view('recruitment-management.dashboard', compact('header', 'sidebar', 'listOfAdvertisement', 'distribution', 'counts', 'advertisement', 'post', 'incompleteCount', 'users', 'application', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser') + [
        'chartData' => [
            'Shortlisted' => $ShortlestedUser,
            'Selected' => $selectedUser ?? 0,
            'Rejected'    => $rejectedUser,
        ]]);
    }

    public function dashboard(){
        $header = true;
        $sidebar = true;
        $header = TRUE;
        $sidebar = TRUE;
        $userId = Auth::guard('web')->user()->id;
        $adverstimentCount = DB::table('nhidcl_recruitment_advertisement')->count();
        $applicationCount = DB::table('nhidcl_rp_applicant_personal_details')->count();

        $statusCounts = DB::table('ref_users as u')
        ->join('nhidcl_user_status as us', 'u.id', '=', 'us.ref_users_id')
        ->join('ref_interview_status as ris', 'us.ref_interview_status_id', '=', 'ris.id')
        ->select('ris.status', DB::raw('COUNT(*) as total'))
        ->whereIn('ris.status', ['SHORTLISTED', 'REJECTED', 'SELECTED', 'RESERVED'])
        ->groupBy('ris.status')
        ->pluck('total', 'status'); // This gives: ['SHORTLISTED' => 10, 'REJECTED' => 5, 'SELECTED' => 7]
        $ShortlestedUser = $statusCounts['SHORTLISTED'] ?? 0;
        $rejectedUser    = $statusCounts['REJECTED'] ?? 0;
        $selectedUser    = $statusCounts['SELECTED'] ?? 0;
        $ReservedUsers   = $statusCounts['RESERVED'] ?? 0;

        if (auth()->user()->hasRole(['HR', 'HR Admin', 'HR-Recruitment'])){
            session(['moduleName' => 'Recruitment Portal']);
            return view('recruitment-management.dashboard', compact('header', 'sidebar', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser', 'adverstimentCount', 'applicationCount') + [
            'chartData' => [
                'Shortlisted' => $ShortlestedUser,
                'Selected' => $selectedUser ?? 0,
                'Rejected'    => $rejectedUser,
            ]]);
        }
    }

    public function myApplication(){
        $header = TRUE;
        $sidebar = TRUE;
        $userId = Auth::guard('web')->user()->id;
        $application = NhidclRecruitmentApplications::with('users', 'advertisementPost', 'status')->where('action', 'submit')->where([
            'ref_users_id' => $userId,
        ])->get();
        return view('recruitment-management.Candidate.my-application', compact('header', 'sidebar', 'application'));
    }

    public function recruitmentVacancies(){
        $header = TRUE;
        $sidebar = TRUE;
        $userId = Auth::guard('web')->user()->id;
        $postdata = AdvertisementPost::with('advertisement')->where('is_active', 1)
        ->orderBy('nhidcl_recruitment_posts.id','desc')
        ->get()
        ->map(function($post) {
            $ids = (array) json_decode($post->mode_of_requirement, true);
            $post->moderecruitment = RefModeOfRecruitment::whereIn('id', $ids)->get();
            return $post;
        });
        return view('recruitment-management.Candidate.post-vacancies', compact('header', 'sidebar', 'postdata'));
    }

    public function candidateDataView(Request $request){
        $header = TRUE;
        $sidebar = TRUE;
        // Restrict access: only HR Recruitment role can view
        if (!auth()->check() || !auth()->user()->hasRole('HR-Recruitment')) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->ajax()) {
            $query = User::where('is_deleted', '!=', '1')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Recruitment User');
            });
            $query->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('recruitment-portal.candidate.application.profile', Crypt::encryptString((string) $row->id));
                    $actionBtn = '<a href="' . $showUrl . '" class="btn btn-default btn-sm bg-blue-700">View</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('recruitment-management.users-view', compact('header', 'sidebar'));
    }

    public function candidateAdvertisement(Request $request)
    {
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        $record = Advertisement::where("expiry_datetime", ">=", today()->format('Y-m-d'))->orderBy('id', 'desc')->get();
        return view("recruitment-management.candidate-advertisement", compact("header", "sidebar", "record"));
    }

    public function candidateArchieveAdvertisement(Request $request)
    {
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        $recordtrash = Advertisement::whereNotNull('deleted_at')->where('expiry_datetime', '<', today()->format('Y-m-d h:i:s'))->orderBy('id', 'desc')->get();
        return view("recruitment-management.candidate-advertisement-archieve", compact("header", "sidebar", "recordtrash"));
    }

    public function candidateAdvertisementShow($id, Request $request){
        $adsId = decrypt($id);
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        $record = Advertisement::find($adsId);
        //$postdata = AdvertisementPost::with('moderecruitment')->where('nhidcl_recruitment_advertisement_id', $adsId)->orderBy('id','desc')->get();
        $postdata = AdvertisementPost::where('nhidcl_recruitment_advertisement_id', $adsId)
        ->orderBy('id','desc')
        ->get()
        ->map(function($post) {
            $ids = (array) json_decode($post->mode_of_requirement, true);
            $post->moderecruitment = RefModeOfRecruitment::whereIn('id', $ids)->get();
            return $post;
        });
        return view("recruitment-management.advertisement-data", compact("header", "sidebar", "record", "postdata"));
    }

    public function candidateAdvertisementPost($id, Request $request){
        $postId = decrypt($id);
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        $record = AdvertisementPost::with(['getPostLocation', 'gateDisciplines', 'gateExamYears'])->find($postId);
        $order = Order::where('entity_id', $record->id)->where('created_by', Auth::id())->latest()->first();
        $userId = Auth::guard('web')->user()->id;
        
        $recordApplication = NhidclRecruitmentApplications::where([
            'ref_users_id' => $userId,
            'nhidcl_recruitment_posts_id' => $postId,
            'nhidcl_recruitment_advertisement_id' => $record->nhidcl_recruitment_advertisement_id,
        ])->first();
        if($recordApplication){
            $resumeFile = $recordApplication->resume_file;
            Session::put('active_tab', 'application');
        }else{
            $resumeFile = '';
            Session::forget('active_tab');
        }
        $passing_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
        $castes = RefCaste::orderBy('caste', 'asc')->get();
        $states = RefState::orderBy('name', 'asc')->get();
        $discipline = RefGateDiscipline::orderBy('discipline_name')->get();
        $previewData = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'upscscore', 'upscscore.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience', 'caste', 'correspondenceState', 'permanentState')->where('ref_users_id', $userId)->first();
        $gateScoreData = NhidclRpGateScoreDetails::where('ref_users_id', $userId)->first();

        $upscScoreData = NhidclRPUpscExam::where('ref_users_id', $userId)->where('nhidcl_recruitment_posts_id', $record->id)->first();
        //dd($previewData->caste->caste);
        // Example: Check if Step 1 (Personal Details) is completed
        $step1Completed = !empty($previewData) && !empty($previewData->user->name);

        // Example: Check if Step 2 (Education Details) is completed
        $step2Completed = !empty($previewData->education) && count($previewData->education) > 0;

        // Example: Check if Step 3 (Gate Score) is completed
        $step3Completed = !empty($previewData->gatescore) && count($previewData->gatescore) > 0;

        // Example: Check if Step 4 (Application) is completed
        $step4Completed = !empty($recordApplication) && !empty($previewData->place_of_application) && !empty($previewData->edu_confirm) && !empty($previewData->caste_confirm) && !empty($previewData->medical_confirm) && !empty($previewData->gov_proof_confirm);
        if ($step4Completed) {
            Session::put('active_tab', 'preview');
        } else {
            Session::forget('active_tab'); // or Session::put('active_tab', 'default')
        }

        if($request->method() == "POST"){
            $data = [
                'ref_users_id' => $userId,
                'nhidcl_recruitment_posts_id' => $postId,
            ];
            // Step 1: If action is "application", only perform application part
            if ($request->action === "application") {
                $this->submitApplication($request, $userId, $postId, $record);
                Alert::success('Success', 'Recruitment application submitted successfully');
                return redirect()->route('recruitment-portal.candidate.advertisement');
            }

            // Step 2: Upload documents and store in user info
            $this->updateUserInfo($request, $userId, $postId);

            // Step 3: Final application submission with resume file
            $this->submitApplication($request, $userId, $postId, $record, true);

            Alert::success('Success', 'Recruitment application submitted successfully');
            return redirect()->route('recruitment-portal.candidate.advertisement.post', encrypt($postId));
        }
        $applicant = RefApplicantPersonalDetails::where('ref_users_id', $userId)->first();

        $applicantedu = NhidclAplicantEducationDetails::with([
                'board_university_college',
                'course_mode',
                'course',
                'main_subject',
                'qualification'
            ])->where('ref_users_id', $userId)->get();
        $applicantexp = NhidclApplicantWorkExperienceDetails::where("ref_users_id", $userId)->get();
        $applicantadd = NhidclApplicantAdditionalDetails::where("ref_users_id", $userId)->get();
        $userAdsInfo = DB::table('nhidcl_recruitment_advertisement_user_info')
            ->where('ref_users_id', $userId)
            ->where('nhidcl_recruitment_posts_id', $postId)
            ->first();
        if($userAdsInfo){
            $applicantLocation = DB::table('nhidcl_recruitment_advertisement_user_preferred_location')->where('nhidcl_recruitment_advertisement_user_info_id', $userAdsInfo->id)->get();
        }else{
            $applicantLocation = null;
        }
        $applicantLocationData = collect($applicantLocation)->pluck('location') // get only the IDs
            ->toArray();
        $applicantState = RefState::whereIn('id', $applicantLocationData)->orderBy('name')->get();

        $preferredLocations = collect($record->getPostLocation)
            ->pluck('ref_state_master_id') // get only the IDs
            ->toArray();
        if(is_array($preferredLocations)){
            $stateList = RefState::whereIn('id', $preferredLocations)->orderBy('name')->get();
        }else{
            $stateList = RefState::where('id', $preferredLocations)->orderBy('name')->get();
        }
        $applicantGateData = DB::table('nhidcl_recruitment_advertisement_user_info as a')
        ->join('ref_passing_year as py', 'a.gate_exam_year_id', '=', 'py.id')
        ->join('ref_gate_discipline as gd', 'a.gate_discpline_id', '=', 'gd.id')
        ->where('a.nhidcl_recruitment_posts_id', $postId)
        ->select(
            'a.*',
            'py.passing_year as passing_year',
            'gd.discipline_name as discipline_name'
        )->first();
        $gateExamYears = collect($record->gateExamYears)
            ->pluck('ref_passing_year_id') // get only the IDs
            ->toArray();

        $gateDiscplineData = collect($record->gateDisciplines)
            ->pluck('ref_gate_discipline_id') // get only the IDs
            ->toArray();

        $gateYears = RefPassingYear::whereIn('id', $gateExamYears)->orderBy('passing_year', 'desc')->take(10)->get();
        $disciplines = RefGateDiscipline::whereIn('id', $gateDiscplineData)->orderBy('discipline_name')->get();
        $ModeRecruitment = json_decode($record->mode_of_requirement, true);
        if (!is_array($ModeRecruitment)) {
            $ModeRecruitment = $ModeRecruitment ? [$ModeRecruitment] : [];
        }

        $refModeRecruitment = RefModeOfRecruitment::whereIn('id', $ModeRecruitment)->orderBy('id')->get();
        return view("recruitment-management.advertisement-post", compact("header", "sidebar", "record", "stateList", "applicant", "applicantedu", "applicantexp", "applicantadd", "applicantLocation", "refModeRecruitment", "recordApplication", "gateYears", "disciplines", "applicantState", "applicantGateData", "passing_years", "castes", "states", "disciplines", "previewData", "step1Completed", "step2Completed", "step3Completed", "step4Completed", "gateScoreData", "upscScoreData", "discipline", "order"));
    }

    private function submitApplication($request, $userId, $postId, $record, $withResume = false)
    {   
        $actionType = $request->input('actiontype') ?? 'draft';
        $data = [
            'consent_one' => $request->boolean('consent_one'),
            'consent_two' => $request->boolean('consent_two'),
            'consent_three' => $request->boolean('consent_three'),
            'consent_four' => $request->boolean('consent_four'),
            'consent_five' => $request->boolean('consent_five'),
            'place_of_application' => $request->place_of_application,
            'nhidcl_application_status_id' => '1',
            'action' => $actionType,
            'applied_at' => now(),
            'ref_users_assigned_id' => $record->created_by,
            'created_by' => $userId,
        ];

        // Only include resume fields if file is uploaded
        if ($request->resume_file) {
            $data['resume_file'] = $request->resume_file;
            $data['resume_path'] = 'uploads/recruitment/advertisement/';
        }

        $application = NhidclRecruitmentApplications::updateOrCreate(
            [
                'ref_users_id' => $userId,
                'nhidcl_recruitment_posts_id' => $postId,
                'nhidcl_recruitment_advertisement_id' => $record->nhidcl_recruitment_advertisement_id,
            ],
            $data
        );

        // Timeline logic (prevent duplicate)
        $timelineExists = NhidclRecruitmentCandidateTimeline::where([
            'ref_users_id' => $userId,
            'nhidcl_recruitment_applications_id' => $application->id,
            'nhidcl_application_status' => '1'
        ])->exists();

        if (!$timelineExists) {
            NhidclRecruitmentCandidateTimeline::create([
                'ref_users_id' => $userId,
                'nhidcl_recruitment_applications_id' => $application->id,
                'nhidcl_application_status' => '1',
                'remarks' => 'Application submitted via candidates.',
                'created_by' => $userId,
            ]);
        }
        $applicationId = "NHIDCL/".date('Y')."/".$postId."/".$userId;
        return $applicationId;
    }

    private function updateUserInfo($request, $userId, $postId)
    {
        $data = [
            'ref_users_id' => $userId,
            'nhidcl_recruitment_posts_id' => $postId,
        ];

        $valuesToUpdate = [
            'ref_mode_of_recruitment_id' => $request->mode_of_requirement,
            'salary_slip_five_month' => $request->upload_file,
            'capital_share_ten_year' => $request->upload_capital_file ?? null,
            'councel_registration_certificate' => $request->upload_capital_file ?? null,
            'gate_exam_year_id' => $request->gate_exam_year,
            'gate_discpline_id' => $request->gate_discpline,
            'gate_score' => $request->gate_score,
            'gate_registration_number' => $request->gate_registration_number,
            'created_by' => $userId,
            'updated_at' => now(),
        ];

        // Insert or update user info
        DB::table('nhidcl_recruitment_advertisement_user_info')->updateOrInsert($data, $valuesToUpdate);

        // Fetch user info ID
        $userInfoId = DB::table('nhidcl_recruitment_advertisement_user_info')
            ->where($data)
            ->value('id');

        if ($userInfoId) {
            // Clean old locations
            DB::table('nhidcl_recruitment_advertisement_user_preferred_location')
                ->where('nhidcl_recruitment_advertisement_user_info_id', $userInfoId)
                ->delete();

            // Insert new locations
            $preferred = $request->preferred_location ?? [];
            $insertData = array_map(function ($location) use ($userInfoId, $userId) {
                return [
                    'nhidcl_recruitment_advertisement_user_info_id' => $userInfoId,
                    'location' => $location,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => $userId,
                ];
            }, $preferred);

            if (!empty($insertData)) {
                DB::table('nhidcl_recruitment_advertisement_user_preferred_location')->insert($insertData);
            }

            Session::put('active_tab', 'application');
        }
    }

    public function candidateAdvertisementPostApplication(Request $request){
        if($request->method() == "POST"){
            $userId = auth()->id();
            $postId  = $request->postid;
            $userId  = auth()->id();
            $record = AdvertisementPost::with(['getPostLocation', 'gateDisciplines', 'gateExamYears'])
                        ->findOrFail($postId);

            // Check personal details
            $personalDetails = NhidclRpApplicantPersonalDetails::where('ref_users_id', $userId)->first();
            if (!$personalDetails) {
                Alert::error('Error', 'Please fill in your personal details first.');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }

            // Check personal details
            $educationDetails = NhidclRpEducationalQualification::where('ref_users_id', $userId)->first();
            if (!$educationDetails) {
                Alert::error('Error', 'Please fill in your education details first.');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }
            if($record?->post_examination=="UPSC"){
                // Check UPSC score details
                $upscScoreDetails = NhidclRPUpscExam::where('ref_users_id', $userId)->first();
                if (!$upscScoreDetails) {
                    Alert::error('Error', 'Please fill in your UPSC score details first.');
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
                }
            }else{
                // Check gate score details
                $gateScoreDetails = NhidclRpGateScoreDetails::where('ref_users_id', $userId)->first();
                if (!$gateScoreDetails) {
                    Alert::error('Error', 'Please fill in your gate score details first.');
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
                }
            }
            
            // Validation
            $validated = $request->validate([
                'consent_one' => 'required|string',
                'consent_two' => 'required|string',
                'consent_three' => 'required|string',
                'place_of_application' => 'required|string',
            ]);
            

            // Application submit logic
            $applicationId = $this->submitApplication($request, $userId, $postId, $record, true);
            $applicationId = $request->applicationid;
            $user = User::findOrFail(auth()->user()->id);
            $previewData = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience')->where('id', $request->applicationid)->first();
            $recordApplication = NhidclRecruitmentApplications::where([
                'ref_users_id' => $user->id,
                'nhidcl_recruitment_posts_id' => $postId,
                'nhidcl_recruitment_advertisement_id' => $record->nhidcl_recruitment_advertisement_id,
            ])->first();

            // // Save or Update
            // NhidclRpApplicantPersonalDetails::updateOrCreate(
            //     ['id' => $request->applicationid],
            //     [
            //         "edu_confirm"          => $request->boolean('edu_confirm'),
            //         "caste_confirm"        => $request->boolean('caste_confirm'),
            //         "medical_confirm"      => $request->boolean('medical_confirm'),
            //         "gov_proof_confirm"    => $request->boolean('gov_proof_confirm'),
            //         "terms_agreement"      => $request->boolean('terms_agreement'),
            //         "serve_location"       => $request->boolean('serve_location'),
            //         "gate_terms_agreement" => $request->boolean('gate_terms_agreement'),
            //         "place_of_application" => $request->place_of_application ?? $previewData->place_of_application,
            //     ]
            // );

            $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $previewData->user->name ?? 'profile-report') . '_' . time() . '.pdf';
            $userPhoto = ($previewData && $previewData->upload_photos_filepath && $previewData->upload_photos) ? viewFilePath($previewData->upload_photos_filepath) . $previewData->upload_photos : "";
            $userSignature = ($previewData && $previewData->upload_signature_filepath && $previewData->upload_signature) ? viewFilePath($previewData->upload_signature_filepath) . $previewData->upload_signature : "";
            $pdf = FacadePdf::loadView('recruitment-management.pdf-profile', compact('previewData', 'record', 'user', 'userPhoto', 'userSignature', 'recordApplication'))
                ->setPaper('a4', 'portrait');
            $pdfContent = $pdf->output();

            // Send Email with PDF
            $actionType = $request->input('actiontype');
            $now = Carbon::now('Asia/Kolkata'); // current datetime in IST
            $displayTime = Carbon::parse($recordApplication->display_time);
            if($actionType==="submit" && $now->lessThanOrEqualTo($displayTime)){
                try {
                    if(!empty($recordApplication->display_time)){
                        NhidclRecruitmentApplicationsLogs::updateOrCreate(
                            [
                                'nhidcl_recruitment_applications_id' => $recordApplication->id,
                            ],
                            [
                                'name' => $previewData->user->name,
                                'longitude' => $request->input('longitude'),
                                'latitude' => $request->input('latitude'),
                                'ip_address' => $request->ip(),
                                'datetime' => now(),
                                'status' => 'submit',
                                'updated_by' => auth()->user()->id,
                            ]
                        );
                    }
                    $applicationIds = 'NHIDCL/' . date('Y') . '/' . ($record?->id ?? '') . '/' . ($user?->id ?? '') ?? '';
                    $post = $record->post_name;                                       // e.g. 6‑digit helper
                    $table = 'REC_APPLICATION_TEMPLATE';
                    // Call your service (SMS / Mail) – handle $isSent boolean  
                    $isSent = $this->otpService->sendOtp('application', $previewData->user->mobile, $post, $table, $applicationIds);
                    if (! $isSent) {
                        Log::error("Unable to send Application Submit SMS. Please try again later.");
                    }
                    
                    Mail::send('emails.application_success', [
                        'user'          => auth()->user(),
                        'applicationId' => $applicationId,
                        'record'        => $record,
                    ], function ($message) use ($pdfContent, $applicationId) {
                        $message->to(auth()->user()->email)
                            ->subject("Recruitment Portal Application Submitted - NHIDCL")
                            ->attachData($pdfContent, "recruitment-application-{$applicationId}.pdf", [
                                'mime' => 'application/pdf',
                            ]);
                    });
                } catch (TransportExceptionInterface $e) {
                    Log::error("Application mail send error message: " . $e->getMessage());
                }

                $applicationIds = 'NHIDCL/' . date('Y') . '/' . ($record?->id ?? '') . '/' . ($user?->id ?? '') ?? '';
                Alert::success('Success', 'You have successfully completed your application for the post Deputy Manager (Technical) on Recruitment Portal of NHIDCL .  Your Application ID is - '.$applicationIds);
            }else{
                Alert::success('Success', 'Your application has been saved as a draft successfully.');
            }
            return redirect()->route('recruitment-portal.candidate.advertisement.post', encrypt($postId));
        }
    }

    public function candidateUploadFiles(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_salary')) {
                    return storeMedia($request, 'uploads/recruitment/advertisement/', $ext, 'upload_salary');
                }

                if ($request->hasFile('upload_share_capital')) {
                    return storeMedia($request, 'uploads/recruitment/advertisement/', $ext, 'upload_share_capital');
                }

                if ($request->hasFile('upload_resume')) {
                    return storeMedia($request, 'uploads/recruitment/advertisement/', $ext, 'upload_resume');
                }

                if ($request->hasFile('upload_photos')) {
                    return storeMedia($request, 'uploads/candidate/photos/', $ext, 'upload_photos');
                }
                if ($request->hasFile('upload_signature')) {
                    return storeMedia($request, 'uploads/candidate/signature/', $ext, 'upload_signature');
                }
                if ($request->hasFile('upload_caste_certificate')) {
                    return storeMedia($request, 'uploads/candidate/caste_certificate/', $ext, 'upload_caste_certificate');
                }
                if ($request->hasFile('upload_disability_proof')) {
                    return storeMedia($request, 'uploads/candidate/disability_proof/', $ext, 'upload_disability_proof');
                }
                if ($request->hasFile('upload_ex_serviceman_proof')) {
                    return storeMedia($request, 'uploads/candidate/ex_serviceman_proof/', $ext, 'upload_ex_serviceman_proof');
                }
                if ($request->hasFile('upload_dob_proof')) {
                    return storeMedia($request, 'uploads/candidate/dob_proof/', $ext, 'upload_dob_proof');
                }
                if ($request->hasFile('marksheet_degree')) {
                    return storeMedia($request, 'uploads/candidate/marksheet_degree/', $ext, 'marksheet_degree');
                }
                if ($request->hasFile('experience_certificate')) {
                    return storeMedia($request, 'uploads/candidate/experience_certificate/', $ext, 'experience_certificate');
                }
                if ($request->hasFile('upload_gate_scorecard')) {
                    return storeMedia($request, 'uploads/candidate/gate_scorecard/', $ext, 'upload_gate_scorecard');
                }
                if ($request->hasFile('upload_identity_proof')) {
                    return storeMedia($request, 'uploads/candidate/identity_proof/', $ext, 'upload_identity_proof');
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
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function candidateViewFiles(Request $request)
    {
        $pathName = $request->pathName;
        $fileName = $request->fileName;
        if (empty($pathName) || empty($fileName) || $pathName === 'null' || $fileName === 'null') {
            return response()->json([
                'success' => false,
                'message' => 'File not found or invalid parameters.'
            ], 400);
        }
        $file = viewFilePath($pathName) . urldecode($fileName);

        if (!empty($file) && file_exists($file)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: inline; filename=" . basename($file));
            header("Content-Type: " . mime_content_type($file));
            header("Content-Length: " . filesize($file));
            header("Content-Transfer-Encoding: binary");
            readfile($file);
            exit;
        } else {
            Alert::error('error', 'Sorry, the file you are trying to access is unavailable.');
            return redirect()->route('recruitment-portal.candidate.advertisement');
        }
    }
    public function profilePDF(Request $request)
    {   
        $user = User::findOrFail(auth()->user()->id);
        $record = AdvertisementPost::with(['getPostLocation', 'gateDisciplines', 'gateExamYears'])->find($request->postid ?? '0');
        $previewData = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'upscscore', 'upscscore.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience')->where('ref_users_id', $user->id)->first();
        $recordApplication = NhidclRecruitmentApplications::where([
            'ref_users_id' => $user->id,
            'nhidcl_recruitment_posts_id' => $request->postid,
            'nhidcl_recruitment_advertisement_id' => $record->nhidcl_recruitment_advertisement_id,
        ])->first();

        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $previewData->user->name ?? 'profile-report') . '_' . time() . '.pdf';
        $userPhoto = ($previewData && $previewData->upload_photos_filepath && $previewData->upload_photos) ? viewFilePath($previewData->upload_photos_filepath) . $previewData->upload_photos : "";
        $userSignature = ($previewData && $previewData->upload_signature_filepath && $previewData->upload_signature) ? viewFilePath($previewData->upload_signature_filepath) . $previewData->upload_signature : "";
        $pdf = FacadePdf::loadView('recruitment-management.pdf-profile', compact('previewData', 'record', 'user', 'userPhoto', 'userSignature', 'recordApplication'))
            ->setPaper('a4', 'portrait');
        return $pdf->download($filename);
    }

    public function stateGroupChoice(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $request->validate([
            // 'priority_choice_first'  => 'required|integer|in:1,2,3,4',
            // 'priority_choice_first_states' => 'required|string',
            // 'priority_choice_second' => 'required|integer|in:1,2,3,4|different:priority_choice_first',
            // 'priority_choice_second_states' => 'required|string',
            // 'priority_choice_three'  => 'required|integer|in:1,2,3,4'
            //                     . '|different:priority_choice_first'
            //                     . '|different:priority_choice_second',
            // 'priority_choice_three_states' => 'required|string',
            'state_group_confirm' => 'accepted'
        ]);
        // $firstgroup = $request->priority_choice_first; // e.g. "2"
        // $firststates = explode(',', $request->priority_choice_first_states); // e.g. ["3","20","21"]
        // $secondgroup = $request->priority_choice_second; // e.g. "2"
        // $secondstates = explode(',', $request->priority_choice_second_states); // e.g. ["3","20","21"]
        // $thirdgroup = $request->priority_choice_three; // e.g. "3"
        // $thirdstates = explode(',', $request->priority_choice_three_states); // e.g. ["3","20","21"]

        $previewData = NhidclRpApplicantPersonalDetails::where('ref_users_id', $user->id)->first();
        // $previewData->priority_choice_first = $firstgroup;
        // $previewData->ref_priority_first_state_id = $firststates;
        // $previewData->priority_choice_second = $secondgroup;
        // $previewData->ref_priority_second_state_id = $secondstates;
        // $previewData->priority_choice_third = $thirdgroup;
        // $previewData->ref_priority_third_state_id = $thirdstates;
        $previewData->state_group_confirm = $request->boolean('state_group_confirm');
        $previewData->save();
        Session::put('active_tab', 'preview');
        Alert::success('Success', 'State Group Priority Added Successfully');
        return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 6);
    }

    public function profileData(){
        $users = Auth::guard('web')->user();
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        return view("recruitment-management.profile", compact("header", "sidebar", "users"));
    }

    public function changePasswordForm(){
        $users = Auth::guard('web')->user();
        $header = true;
        $sidebar = true;
        session(['moduleName' => 'Recruitment Portal']);
        return view("recruitment-management.change-password", compact("header", "sidebar", "users"));

    }

    public function updatePasswordProfile(Request $request){
        $user = Auth::guard('web')->user();
        $user = User::find($user->id);
        if (!$user) {
            Alert::error('Error', 'User not found.');
            return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['error' => 'User not found']);
        }
        $nameParts = explode(' ', strtolower($user->name ?? ''));

        // 🔹 Step 1: Decrypt the incoming password fields using session salt
        $currentPassword = decryptPassword($request->input('current_password'), session('salt'));
        $decryptedNewPassword = decryptPassword($request->input('password'), session('salt'));
        $decryptedPasswordConfirmation = decryptPassword($request->input('password_confirmation'), session('salt'));
        
        // Replace request input values with decrypted passwords
        $request->merge([
            'current_password' => $currentPassword,
            'password' => $decryptedNewPassword,
            'password_confirmation' => $decryptedPasswordConfirmation,
        ]);
        // 🔹 Step 2: Validate input (including email, token, captcha, and password rules)
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('email', $request->email)->first();
                    $userName = strtolower(trim($user->name ?? ''));
                    $passwordLower = strtolower($value);

                    if (preg_match('/(012|123|234|345|456|567|678|789|abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz)/i', $value)) {
                        $fail('The '.$attribute.' cannot contain three or more consecutive letters or numbers (e.g., 123, abc).');
                    }

                    $nameParts = array_filter(explode(' ', $userName));
                    foreach ($nameParts as $part) {
                        if (!empty($part) && str_contains($passwordLower, $part)) {
                            $fail('The '.$attribute.' should not include your first or last name.');
                            break;
                        }
                    }
                },
            ],            
            'captcha' => 'required|captcha',
        ], [
            'password.confirmed' => 'Password and confirmation do not match.',
        ]);

        if ($validator->fails()) {            
            return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors($validator)
                ->withInput();
        }
        
        $rateLimitKey = $request->u_id . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['error' => "Too many reset password attempts. Please try again 24 hours."]);
        }

        try {
            
            if (!$currentPassword) {
                return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['current_password' => 'Invalid current password format.']);
            }
            if (!Hash::check($currentPassword, $user->password)) {
                Alert::error('Error', 'The current password is incorrect.');
                return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if ($request->current_password === $request->password) {
                Alert::error('Error', 'New password cannot be the same as the old password.');
                return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['password' => 'New password cannot be the same as the old password.']);
            }

            $user->password = Hash::make($decryptedNewPassword);
            $user->save();
            
            // Log the password change
            //Log::info('Password changed successfully for user ID: ' . $user->id);
            (new UserActivityController())->logActivity('User account password change successfully', $user->id);
            
            RateLimiter::hit($rateLimitKey, 1200);
            // Logout other sessions before changing password
            Session::where('user_id', $user->id)->delete();
            Auth::logoutOtherDevices($currentPassword);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('recruitment.login')->with('success', 'Password changed successfully. Please log in again.');
        } catch (\Exception $e) {
            Log::error('Password change failed for user: ' . $e->getMessage());

            Alert::error('Error', 'Something went wrong. Please try again later.');
            return redirect()->route('recruitment-portal.recruitment.change.password')->withErrors(['error' => 'Internal error occurred.']);
        }
    }

    public function userLoginHistory(Request $request){
        $activities = UserActivity::where('ref_users_id', Auth::id())->whereDate('created_at', Carbon::today())->latest()->take(10)->get();
        $header = true;
        $sidebar = true;
        return view('profile.login_history', compact('activities', 'header', 'sidebar'));
    }

    protected function logout(Request $request)
    {
        $user = Auth::user();

        if ($user && $user instanceof \App\Models\User) {
            (new UserActivityController())->logActivity('User logged out successfully', $user->id);

            // Update login status
            $user->update(['is_logged' => 0]);

            // Logout & invalidate session
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('recruitment.login')->with('success', 'You have been logged out successfully. Please log in again.');
        }

        // Fallback: force logout if no user found
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }


}
