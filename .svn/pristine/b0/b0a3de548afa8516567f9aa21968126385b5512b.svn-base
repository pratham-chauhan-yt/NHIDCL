<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruitment\CandidateProfile\RpEducationalDetailRequest;
use App\Http\Requests\Recruitment\CandidateProfile\RpPersonalDetailRequest;
use App\Models\Recruitment\CandidateProfile\{NhidclRpApplicantPersonalDetails,NhidclRpEducationalQualification,NhidclRpWorkExperience};
use App\Models\Recruitment\{NhidclRpGateScoreDetails, NhidclRecruitmentApplications, Advertisement, AdvertisementPost};
use App\Models\{RefCaste,RefGateDiscipline,RefPassingYear,RefState};
use App\Models\{User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SelectionProcessCandidateExport;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;

use function PHPSTORM_META\map;

class CandidateProfileController extends Controller
{
    public function __construct()
    {
    }

    public function candidateProfile(Request $request)
    {
        $passing_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
        $castes = RefCaste::orderBy('caste', 'asc')->get();
        $states = RefState::orderBy('name', 'asc')->get();
        $disciplines = RefGateDiscipline::orderBy('discipline_name')->get();
        $header = true;
        $sidebar = true;
        $userId = auth()->user()->id;
        $previewData = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience')->where('ref_users_id', $userId)->first();
        return view("recruitment-management.Candidate.applicantCandidateProfile", compact("header", "sidebar", "passing_years", "castes", "states", "disciplines", "previewData"));
    }

    public function personalDetails(RpPersonalDetailRequest $request)
    {   
        try {
            $dataArr = $request->only([
                "full_name",
                "date_of_birth",
                "father_husband_name",
                "mother_name",
                "marital_status",
                "gender",
                "aadhar_number",
                "pwbd",
                "indian_citizen",
                "correspondence_address",
                "correspondence_city",
                "correspondence_pincode",
                "permanent_address",
                "permanent_city",
                "permanent_pincode",
            ]);
            if ($dataArr['marital_status'] !== 'Married') {
                $dataArr['spouse_name'] = null;
            }
            $userId = Auth::guard('web')->user()->id;
            $dataArr += [
                'name' => $request->full_name,
                'date_of_birth' => $request->date_of_birth,
                'citizenship_consent' => $request->boolean('citizenship_consent')? 1 : 0,
                'indian_citizen' => $request->boolean('indian_citizen'),
                'ref_caste_id' => $request->category,
                'category_confirm' => $request->boolean('category_confirm')? 1 : 0,
                'ref_correspondence_state_id' => $request->correspondence_state,
                'ref_permanent_state_id' => $request->permanent_state,
                'ref_users_id' => $userId,
                'disability' => $request->disability,
                'disability_consent' => $request->input('disability_consent', 0) ? 1 : 0,
                'ex_serviceman' => $request->boolean('ex_serviceman'),
                'ex_serviceman_consent' => $request->input('ex_serviceman_consent', 0) ? 1 : 0,
                'spouse_name' => $request->spouse_name,
                'dob_consent' => $request->input('dob_consent', 0) ? 1 : 0,
            ];
            //dd($dataArr);
            $fileFields = [
                'upload_photoss' => 'upload_photos',
                'upload_signaturee' => 'upload_signature',
                'upload_caste_certificatee' => 'upload_caste_certificate',
                'upload_disability_prooff' => 'upload_disability_proof',
                'upload_dob_prooff' => 'upload_dob_proof',
                'upload_ex_serviceman_prooff' => 'upload_ex_serviceman_proof',
                'upload_identity' => 'upload_identity_proof',
            ];

            foreach ($fileFields as $requestField => $dbField) {
                if (!empty($request->$requestField)) {
                    $fileDetails = extractFileDetails($request->$requestField);
                    $dataArr[$dbField] = $fileDetails['fileName'] ?? null;
                    $dataArr[$dbField . '_filepath'] = $fileDetails['filePath'] ?? null;
                }
            }

            foreach ($fileFields as $requestField => $dbField) {
                $uploadedFile = $request->$requestField;
                if (!empty($uploadedFile)) {
                    $fileDetails = extractFileDetails($request->$requestField);
                    $dataArr[$dbField] = $fileDetails['fileName'] ?? null;
                    $dataArr[$dbField . '_filepath'] = $fileDetails['filePath'] ?? null;
                } else {
                    // case 2: file removed (explicitly set to null)
                    $dataArr[$dbField] = null;
                    $dataArr[$dbField . '_filepath'] = null;
                }
            }
            // Save or update
            $existing = NhidclRpApplicantPersonalDetails::where('ref_users_id', $dataArr['ref_users_id'])->first();

            if ($existing) {
                $updatedData = $existing->update($dataArr);
            } else {
                NhidclRpApplicantPersonalDetails::create($dataArr);
            }

            Alert::success('Success', 'Personal Details Added Successfully');
            Session::put('active_tab', 'education');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 1);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('error', $e->getMessage());
        }
    }

    public function educationalDetails(RpEducationalDetailRequest $request)
    {
        try {
            $existing = NhidclRpApplicantPersonalDetails::where('ref_users_id', auth()->id())->first();
            if (!$existing) {
                Alert::error('Error', 'Please fill in your personal details first.');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }

            $validated = $request->validated();

            $dataArr = $request->only([
                "examination",
                "institute_name",
                "university_board",
                "passing_year",
                "percentage_cgpa",
            ]);

            $dataArr['percentage_cgpa'] = number_format($request->percentage_cgpa, 2);
            $dataArr['ref_users_id'] = Auth::guard('web')->user()->id;
            $dataArr['edu_confirm'] = $request->boolean('edu_confirm');

            if (!empty($request->marksheet_degreee)) {
                $marksheet = extractFileDetails($request->marksheet_degreee);
                $dataArr['marksheet'] = $marksheet["fileName"] ?? null;
                $dataArr['marksheet_filepath'] = $marksheet["filePath"] ?? null;
            }

            $save = NhidclRpEducationalQualification::create($dataArr);

            if ($save) {

                Alert::success('Success', 'Education Details added Successfully');
                if ($request->eduClickedFrom == "educationalDetailsBtn1") {
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 2);
                } else {
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 1);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('error', $e->getMessage());
        }
    }

    public function educationalDetailsDelete($id)
    {
        try {
            // Find record
            $education = NhidclRpEducationalQualification::findOrFail($id);

            // Soft delete (make sure model uses SoftDeletes trait)
            $education->delete();

        } catch (\Exception $e) {
            Log::error("Error deleting education details: " . $e->getMessage(), ['exception' => $e]);
            Alert::error('Error', 'Something went wrong. Please try again later.');
        }
    }


    public function workExperienceDetails(Request $request)
    {
        try {
            $userId = auth()->id();

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

            // Check gate score details
            $gateScoreDetails = NhidclRpGateScoreDetails::where('ref_users_id', $userId)->first();
            if (!$gateScoreDetails) {
                Alert::error('Error', 'Please fill in your gate score details first.');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }
            $validated = $request->validate([
                'employer_name' => [
                    'required',
                    'string',
                    'max:255',
                    'not_regex:/<[^>]*script[^>]*>/i', // Basic script tag detection
                ],
                'post_held' => [
                    'required',
                    'string',
                    'max:255',
                    'not_regex:/<[^>]*script[^>]*>/i' // Prevent script tags
                ],
                'from_date' => 'required|date|before_or_equal:to_date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'job_description' => 'required|string|max:500',
                //'experience_certificate' => 'required|file|mimes:pdf|max:2048',
            ]);

            $dataArr = $request->only([
                "employer_name",
                "post_held",
                "from_date",
                "to_date",
                "job_description",
            ]);

            //$save = NhidclRpEducationalQualification::create($dataArr);

            // $expCertificate = extractFileDetails($request->experience_certificatee);
            // $dataArr['experience_certificate'] = @$expCertificate["fileName"];
            // $dataArr['experience_certificate_filepath'] = @$expCertificate["filePath"];
            $users = Auth::guard('web')->user();

            $dataArr['ref_users_id'] = $users->id;
            $dataArr['ref_work_experience_year_id'] = calculateRoundedYearDifference($request->from_date, $request->to_date);
            $dataArr['experience_consent'] = $request->experience_consent;
            $save = NhidclRpWorkExperience::create($dataArr);

            $application = NhidclRpApplicantPersonalDetails::where('ref_users_id', $users->id)->firstOrFail();
            $application->submit_experience = NULL;
            $application->save();

            if ($save) {
                Alert::success('Success', 'Work Experience added successfully');

                if ($request->workClickedFrom == "workExperienceDetailsBtn") {
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 2);
                } else {
                    return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 2);
                }
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('error', $e->getMessage());
        }
    }

    public function workExperienceDetailsDelete($id, Request $request){
        try {
            $experience = NhidclRpWorkExperience::find(Crypt::decrypt($id));
            
            if (!$experience) {
                Alert::error('Error', 'Work experience details not found.');
                return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
            }
            $experience->delete(); // This will now soft delete
            Alert::success('Success', 'it has been moved to trash');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error($e->getMessage());
            Alert::error('Error', 'Invalid Work experience details.');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Alert::error('Error', 'Operation failed due to a server error. Please retry.');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
        }
    }

    public function workExperienceChoice(Request $request){
        $request->validate([
            'submit_experience' => 'required|in:1,2',
        ]);
        $users = Auth::guard('web')->user();
        $application = NhidclRpApplicantPersonalDetails::where('ref_users_id', $users->id)->firstOrFail();
        $application->submit_experience = $request->submit_experience;
        $application->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->to($request->redirect_url)->with('active_tab', 'next_tab_name');
    }

    public function gateScoreDetails(Request $request){
        try {

            $userId = auth()->id();

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

            // fetch existing record
            
            $existing = NhidclRpGateScoreDetails::where('ref_users_id', $userId)->first();

            // build validation rules dynamically
            $rules = [
                'gate_exam_year' => 'required|exists:ref_passing_year,id',
                'gate_discpline' => 'required|exists:ref_gate_discipline,id',
                'gate_score' => [
                    'required',
                    'regex:/^\d+(\.\d{1,2})?$/', // only numbers or decimal up to 2 digits
                ],
                'gate_registration_number' => [
                    'required',
                    'regex:/^[A-Za-z0-9\/]+$/', // alphanumeric + slash only
                ],
                'gate_consent' => 'accepted',
            ];

            $messages = [
                'gate_exam_year.required' => 'Please select GATE Exam Year.',
                'gate_exam_year.exists' => 'Invalid GATE Exam Year selected.',
                'gate_discpline.required' => 'Please select GATE Discipline.',
                'gate_discpline.exists' => 'Invalid GATE Discipline selected.',
                'gate_score.required' => 'Please enter your GATE score.',
                'gate_score.regex' => 'Please enter a valid GATE score (numbers with up to 2 decimals).',
                'gate_registration_number.required' => 'Please enter your GATE registration number.',
                'gate_registration_number.regex' => 'Only letters, numbers, and slash (/) are allowed in registration number.',
                'gate_consent.accepted' => 'You must accept the consent checkbox.',
            ];

            
            // only require upload if record does NOT exist
            if (!$existing || !$existing->gatescore_certificate) {
                $rules['upload_gate_scorecard'] = 'required|file';
            } else {
                $rules['upload_gate_scorecard'] = 'nullable|file';
            }
            $validated = $request->validate($rules, $messages);
            
            
            // if ($validated['all_india_rank'] > $validated['number_of_candidate']) {
            //     return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->withErrors(['error' => 'All India Rank cannot be greater than Total Number of Candidates'])->withInput();
            // }
            // base data for update
            $data = [
                'ref_passing_year_id' => $validated['gate_exam_year'],
                'ref_discipline_id' => $validated['gate_discpline'],
                'gate_score' => $validated['gate_score'],
                'gate_registration_number' => $validated['gate_registration_number'],
                //'all_india_rank' => $validated['all_india_rank'],
                //'number_of_candidate' => $validated['number_of_candidate'],
                //'gate_percentile' => $validated['gate_percentile'],
                'gate_consent' => $request->boolean('gate_consent'),
                'created_by' => user_id(),
                'created_at' => now(),
            ];
            // only add file fields if new file uploaded
            if ($request->upload_gate_scorecardd){
                $gateScoreCertificate = extractFileDetails($request->upload_gate_scorecardd);

                $data['gatescore_certificate'] = $gateScoreCertificate['fileName'];
                $data['gatescore_certificate_filepath'] = $gateScoreCertificate['filePath'];
            }

            NhidclRpGateScoreDetails::updateOrCreate(
                ['ref_users_id' => user_id()],
                $data
            );
            Alert::success('Success', 'Gate Score added successfully');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with("error", $e->getMessage());
        }
    }

    public function gateScoreDataTable(Request $request){
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclRpGateScoreDetails::with(['passingYear', 'gateDiscpline'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('reg_number', function ($row) {
                    return $row->gate_registration_number ?: 'N/A';
                })
                ->addColumn('passing_year', function ($row) {
                    return optional($row->passingYear)->passing_year ?: 'N/A';
                })
                ->addColumn('discpline', function ($row) {
                    return optional($row->gateDiscpline)->discipline_name ?: 'N/A';
                })
                ->addColumn('score', function ($row) {
                    return $row->gate_score ?: 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $deleteUrl = route('recruitment-portal.candidate.gate.score.delete', $id);

                    return '
                    <div class="inline-flex">
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function deleteGateScore($id, Request $request){
        try {
            $decryptedId = Crypt::decrypt($id);
            $gateData = NhidclRpGateScoreDetails::findOrFail($decryptedId);
            $gateData->delete();
            Alert::success('Success', 'Gate score record deleted successfully.');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('success', 'Gate score record deleted successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('error', 'Invalid ID or record not found.');
        }
    }

    public function candidate_details(Request $request)
    {
        $tab_id = str_replace("defaultOpen", "", $request->tab_id);
        $userId = Auth::guard('web')->user()->id;
        $Data = array();
        // Check if previous tab is completed
        if ($tab_id == "2") { 
            $personal = NhidclRpApplicantPersonalDetails::where("ref_users_id", $userId)->first();
            if(empty($personal)){
                $Data['tab_id'] = '1';
                $Data['data'] = null;
                Alert::error('Sorry', 'Please complete Personal Details (Tab 1) before proceeding.');
            }else{
                $Data['tab_id'] = $tab_id;
                $Data['data'] = NhidclRpEducationalQualification::with('passingYear')
                ->where("ref_users_id", $userId)
                ->orderBy("created_at", "DESC")
                ->get();
            }
            
        }

        if ($tab_id == "3") {
            $education = NhidclRpEducationalQualification::where("ref_users_id", $userId)->exists();
            if (!$education) {
                $Data['tab_id'] = '2';
                $Data['data'] = null;
                Alert::error('Sorry', 'Please complete Educational Qualifications (Tab 2) before proceeding.');
            }
            $Data['tab_id'] = $tab_id;
            $Data['data'] = NhidclRpWorkExperience::where("ref_users_id", $userId)
                ->orderBy("created_at", "DESC")
                ->get();
        }

        if ($tab_id == "1") {
            $Data['tab_id'] = '1';
            $Data['data'] = NhidclRpApplicantPersonalDetails::where("ref_users_id", $userId)->first();
        }

        return response()->json([
            'status' => 'success',
            'data'   => $Data
        ], 200);
    }

    public function delete_candidate(Request $request)
    {
        if ($request->tab_id == 2) {
            $data = NhidclRpEducationalQualification::find($request->id);

            if ($data->delete()) {
                $file = checkFileExist($data->marksheet_degree_filepath, $data->marksheet_degree);
                if ($file)
                    unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('recruitment-portal.candidate.profile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('recruitment-portal.candidate.profile');
            }
        }
        if ($request->tab_id == 3) {
            $data = NhidclRpWorkExperience::find($request->id);

            if ($data->delete()) {
                $file = checkFileExist($data->experience_certificate_filepath, $data->experience_certificate);
                if ($file)
                    unlink($file);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->route('recruitment-portal.candidate.profile');
            } else {
                Alert::success('Error', 'Something went wrong');
                return redirect()->route('recruitment-portal.candidate.profile');
            }
        }
    }

    public function candidateApplicationDisclosure(Request $request){
        // Save or update
        $existing = NhidclRpApplicantPersonalDetails::where('id', $request->applicationid)->first();
        if ($existing) {
            $termsAgreementValue = $request->has('terms_agreement') ? 1 : 0;
            $dataArr = ["terms_agreement" => $termsAgreementValue];
            $updatedData = $existing->update($dataArr);
        }
        Alert::success('Success', 'Applicant disclosure submit successfully');
        return redirect($request->input('redirect_url', route('recruitment-portal.candidate.profile')))->with('tab', 1);
    }

    public function candidateApplicationProfile(Request $request, $postId, $usersId){
        try {
            $userId = Crypt::decryptString($usersId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404, 'Invalid ID');
        }
        $header = true;
        $sidebar = true;
        $user = User::findOrFail($userId);
        $record = AdvertisementPost::with(['getPostLocation', 'gateDisciplines', 'gateExamYears'])->find($postId);
        $postview = AdvertisementPost::find($postId);
        $recordApplication = NhidclRecruitmentApplications::where([
            'ref_users_id' => $userId,
            'nhidcl_recruitment_posts_id' => $postId,
            'nhidcl_recruitment_advertisement_id' => $postview->nhidcl_recruitment_advertisement_id,
        ])->first();
         
        $previewData = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience')->where('ref_users_id', $user?->id)->first();
        if(!$postview && !$previewData){
            Alert::error('Sorry', 'Applicant profile details not found');
            return redirect(route('recruitment-portal.candidate.view'));
        }
        return view("recruitment-management.Candidate.applicant-profile-preview", compact("header", "sidebar", "previewData", "recordApplication", "record", "postview"));
    }

    public function exportSelectionData(Request $request)
    {
        $advertisementId = $request->input('advertisement_id');
        $postId          = $request->input('post_id');
        $nameFilter      = $request->input('name');
        $emailFilter     = $request->input('email');
        $mobileFilter    = $request->input('mobile');
        $gateRegNo       = $request->input('gate_reg_number');
        $gateYear        = $request->input('gate_year');
        $gateScore       = $request->input('gate_scor');
        $age             = $request->input('age');
        $category        = $request->input('category');
        $percentile      = $request->input('percentile');
        $statusId        = $request->input('status') ?? '1';

        if ($advertisementId && $postId) {

            $query = NhidclRecruitmentApplications::with(['users', 'status', 'interview', 'gatescore', 'application', 'advertisement'])
                ->where("nhidcl_recruitment_advertisement_id", $advertisementId)
                ->where("nhidcl_recruitment_posts_id", $postId)
                ->where("nhidcl_application_status_id", $statusId)
                ->where("action", "submit");

            $advertisement = Advertisement::find($advertisementId);
            $asOnDate = $advertisement->as_on_date;

            // --- Filters ---
            if (!empty($nameFilter)) {
                $query->whereHas('users', fn($q) => $q->where('name', 'like', "%{$nameFilter}%"));
            }

            if (!empty($emailFilter)) {
                $query->whereHas('users', fn($q) => $q->where('email', 'like', "%{$emailFilter}%"));
            }

            if (!empty($mobileFilter)) {
                $query->whereHas('users', fn($q) => $q->where('mobile', 'like', "%{$mobileFilter}%"));
            }

            if (!empty($gateRegNo)) {
                $query->whereHas('gatescore', fn($q) => $q->where('gate_registration_number', 'like', "%{$gateRegNo}%"));
            }

            if (!empty($gateYear)) {
                $query->whereHas('gatescore', fn($q) => $q->where('ref_passing_year_id', $gateYear));
            }

            if (!empty($gateScore)) {
                $query->whereHas('gatescore', fn($q) => $q->where('gate_score', '>=', $gateScore));
            }

            if (!empty($age) && $asOnDate) {
                $query->whereHas('users', function ($q) use ($age, $asOnDate) {
                    $q->whereRaw("EXTRACT(YEAR FROM age(?, ref_users.date_of_birth)) <= ?", [$asOnDate, $age]);
                });
            }

            if (!empty($category)) {
                $query->whereHas('application', fn($q) => $q->where('ref_caste_id', $category));
            }

            // --- Data Retrieval ---
            $data = $query->orderBy('applied_at')->get()->map(function ($item) {
                if ($item->users) {
                    $item->users->users_id = Crypt::encryptString($item->users->id);
                }
                return $item;
            });

            // --- Category & Disability Counts ---
            $categoryCounts = [];
            $disabilityCounts = [];

            foreach ($data as $items) {
                $category = !empty($items->application[0])
                    ? optional($items->application[0]->caste)->caste
                    : 'Null';

                $categoryCounts[$category] = ($categoryCounts[$category] ?? 0) + 1;

                $disability = !empty($items->application[0])
                    ? trim($items->application[0]->disability)
                    : '';

                if ($disability !== '') {
                    $disabilityCounts[$disability] = ($disabilityCounts[$disability] ?? 0) + 1;
                }
            }

            // --- ✅ Sanitize for CSV Injection before export ---
            $safeData = $data->map(function ($item) {
                $sanitize = function ($value) {
                    $value = (string) $value;
                    if ($value === '') return $value;

                    $firstChar = $value[0];
                    $dangerousStart = ['=', '+', '-', '@', "\t", "\r"];
                    return in_array($firstChar, $dangerousStart, true) ? "'" . $value : $value;
                };

                // sanitize user-related fields
                if ($item->users) {
                    $item->users->name = $sanitize($item->users->name);
                    $item->users->email = $sanitize($item->users->email);
                    $item->users->mobile = $sanitize($item->users->mobile);
                }

                // sanitize GATE details if present
                if ($item->gatescore && isset($item->gatescore->gate_registration_number)) {
                    $item->gatescore->gate_registration_number = $sanitize($item->gatescore->gate_registration_number);
                }

                // sanitize application details
                if (!empty($item->application[0])) {
                    $item->application[0]->disability = $sanitize($item->application[0]->disability ?? '');
                }

                return $item;
            });

            // --- Final Export ---
            return Excel::download(
                new SelectionProcessCandidateExport($safeData, $categoryCounts, $disabilityCounts),
                'selection-process-candidates.xlsx'
            );
        }
    }

}
