<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\NhidclRecruitmentOfferLetter;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\FileService;
use Illuminate\Support\Facades\Crypt;
use Exception;
use App\Models\User;
use App\Models\Recruitment\Advertisement;
use App\Models\Recruitment\AdvertisementPost;
use App\Models\Recruitment\NhidclRecruitmentApplications;
use App\Models\Recruitment\NhidclRecruitmentApplicationsLogs;
use App\Models\Recruitment\NhidclRecruitmentCandidateTimeline;
use App\Models\Recruitment\NhidclRecruitmentInterviews;
use App\Http\Requests\Recruitment\{AdvertisementRequest};
use App\Models\NhidclApplicationStatus;
use App\Models\{RefPassingYear, RefCaste};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicantLogDataExport;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Recruitment-User|HR-Recruitment');
    }

    public function index()
    {
        $header = true;
        $sidebar = true;
        $record = Advertisement::orderBy('id', 'desc')->get();
        return view("recurement_advertisement.index", compact("header", "sidebar", "record"));
    }

    public function store(AdvertisementRequest $request)
    {
        try {
            $arr = [
                'advertisement_title' => $request->advertisement_title,
                'as_on_date' => $request->as_on_date,
                'start_datetime' => $request->start_datetime,
                'expiry_datetime' => $request->expiry_datetime,
                'note_instruction' => $request->note_instruction,
                'advertisement_file' => $request->upload_file,
            ];
            Advertisement::create($arr);

            Alert::success('Success', 'Advertisement has created successfully');
            return redirect()->route('recruitment-portal.advertisement.index');
        } catch (Exception $e) {
            Alert::error('error', 'Something went wrong');
            return redirect()->route('recruitment-portal.advertisement.index');
        }
    }

    public function edit($id)
    {
        $header = true;
        $sidebar = true;
        $id = Crypt::decrypt($id);
        $record = Advertisement::orderBy('id', 'desc')->get();
        $edit_record = Advertisement::find($id);
        $note_instruction = json_decode($edit_record->note_instruction);
        return view("recurement_advertisement.edit", compact("header", "sidebar", "record", "edit_record", "note_instruction"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'advertisement_title' => 'required|string|max:255',
            'as_on_date' => 'required|date',
            'start_datetime' => 'required|date',
            'expiry_datetime' => 'required|date|after:start_datetime',
            'note_instruction' => 'string|max:500',
        ]);

        $id = Crypt::decrypt($id);
        $arr = [
            'advertisement_title' => $request->advertisement_title,
            'as_on_date' => $request->as_on_date,
            'start_datetime' => $request->start_datetime,
            'expiry_datetime' => $request->expiry_datetime,
            'note_instruction' => json_encode($request->note_instruction),
        ];
        $record = Advertisement::find($id);
        if ($request->hasFile('advertisement_file')) {
            // Store the image in the public folder
            // $imageName = time() . '.' . $request->advertisement_file->extension();
            // $request->advertisement_file->move(public_path('images/advertisement_file'), $imageName);
            $arr['advertisement_file'] = $request['upload_file'];
        }
        // print_r($arr);


        // print_r($request->all());

        // die;
        $record->where('id', $id)->update($arr);
        Alert::success('Success', 'Advertisement has updated successfully');
        return redirect()->route('recruitment-portal.advertisement.index');
    }

    public function show($id)
    {
        try {
            $header = true;
            $sidebar = true;
            $id = Crypt::decrypt($id);
            $record = Advertisement::orderBy('id', 'desc')->get();
            $edit_record = Advertisement::find($id);
            $note_instruction = json_decode($edit_record->note_instruction);
            return view("recurement_advertisement.show", compact("header", "sidebar", "record", "edit_record", "note_instruction"));
        } catch (Exception $e) {
            Alert::error('error', 'Something went wrong');
            return redirect()->route('recruitment-portal.advertisement.index');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = Advertisement::findOrFail($id);
            $data->delete(); // soft delete now
            Alert::success('Success', 'Advertisement has been moved to trash successfully');
            return redirect()->route('recruitment-portal.advertisement.index');
        } catch (Exception $e) {
            Log::error("Advertisement delete error: " . $e->getMessage());
            Alert::error('error', $e->getMessage());
            return redirect()->route('recruitment-portal.advertisement.index');
        }
    }

    public function selectionProcess(Request $request)
    {
        $header = true;
        $sidebar = true;
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
        $years = RefPassingYear::OrderBy('passing_year', 'DESC')->get();
        $category = RefCaste::OrderBy('caste', 'ASC')->get();
        $listOfAdvertisement = Advertisement::whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view("recruitment-management.selection-process", compact("header", "sidebar", "years", "category", "listOfAdvertisement"));
    }

    public function selectionProcessCandidate(Request $request)
    {
        if ($request->ajax()) {
            $advertisementId = $request->input('advertisementId');
            $postId          = $request->input('postId');
            $statusId        = $request->input('status');
            $nameFilter      = $request->input('name_filter');
            $emailFilter     = $request->input('email_filter');
            $mobileFilter    = $request->input('mobile_filter');
            $gateRegNo       = $request->input('gate_registartion_filter');
            $gateYear        = $request->input('gate_year_filter');
            $gateScore       = $request->input('gate_score_filter');
            $age             = $request->input('age_filter');
            $category        = $request->input('category_filter');
            $percentile      = $request->input('percentile_filter');
            $gender          = $request->input('gender_filter');
            $marital          = $request->input('marital_status_filter');
            $pwbd          = $request->input('pwbd_filter');

            if ($postId) {
                $application = NhidclApplicationStatus::select('id', 'status')
                    ->where('type', 'application')
                    ->whereNotIn('id', [1, 2, 3])
                    ->orderBy('id')
                    ->get();

                $interview = NhidclApplicationStatus::select('id', 'status')
                    ->where('type', 'interview')
                    ->get();

                $query = NhidclRecruitmentApplications::with(['users', 'status', 'interview', 'gatescore', 'application', 'application.caste', 'advertisement'])
                    ->where("nhidcl_recruitment_advertisement_id", $advertisementId)
                    ->where("nhidcl_recruitment_posts_id", $postId)
                    ->where("action", "submit");
                
                $advertisement = Advertisement::find($advertisementId);
                $asOnDate = $advertisement->as_on_date;

                // status filter if provided
                if (!empty($statusId)) {
                    $query->where("nhidcl_application_status_id", $statusId);
                }

                // name filter
                if (!empty($nameFilter)) {
                    $query->whereHas('users', function ($q) use ($nameFilter) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($nameFilter) . '%']);
                    });
                }

                // email filter
                if (!empty($emailFilter)) {
                    $query->whereHas('users', function ($q) use ($emailFilter) {
                        $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($emailFilter) . '%']);
                    });
                }

                // mobile filter
                if (!empty($mobileFilter)) {
                    $query->whereHas('users', function ($q) use ($mobileFilter) {
                        $q->where('mobile', 'like', "%{$mobileFilter}%");
                    });
                }

                // GATE registration filter
                if (!empty($gateRegNo)) {
                    $query->whereHas('gatescore', function ($q) use ($gateRegNo) {
                        $q->whereRaw('LOWER(gate_registration_number) LIKE ?', ['%' . strtolower($gateRegNo) . '%']);
                    });
                }

                // GATE year filter
                if (!empty($gateYear)) {
                    $query->whereHas('gatescore', function ($q) use ($gateYear) {
                        $q->where('ref_passing_year_id', $gateYear);
                    });
                }

                // GATE score filter
                if (!empty($gateScore)) {
                    $query->whereHas('gatescore', function ($q) use ($gateScore) {
                        $q->where('gate_score', '>=', $gateScore);
                    });
                }

                // Age filter
                if (!empty($age) && $asOnDate) {
                    $query->whereHas('users', function ($q) use ($age, $asOnDate) {
                        $q->whereRaw("EXTRACT(YEAR FROM age(?, ref_users.date_of_birth)) <= ?", [$asOnDate, $age]);
                    });
                }

                // Category filter
                if (!empty($category)) {
                    $query->whereHas('application', function ($q) use ($category) {
                        $q->where('ref_caste_id', $category);
                    });
                }

                // Gender filter
                if (!empty($gender)) {
                    $query->whereHas('application', function ($q) use ($gender) {
                        $q->where('gender', $gender);
                    });
                }

                // Marital Status filter
                if (!empty($marital)) {
                    $query->whereHas('application', function ($q) use ($marital) {
                        $q->where('marital_status', $marital);
                    });
                }

                // PwBd filter
                if (!empty($pwbd)) {
                    $query->whereHas('application', function ($q) use ($pwbd) {
                        $q->where('pwbd', $pwbd);
                    });
                }

                // Percentile filter
                if (!empty($percentile)) {
                    $query->whereHas('gatescore', function ($q) use ($percentile) {
                        $q->where('gate_percentile', '>=', $percentile);
                    });
                }  
                $data = $query->orderBy('applied_at')->paginate(100);

                foreach ($data as $item) {
                    if ($item->users) {
                        $item->users->users_id = Crypt::encryptString($item->users->id);
                    }
                }

                return response()->json([
                    'status'      => true,
                    'data'        => $data->items(),
                    'total'       => $data->total(),
                    'currentPage' => $data->currentPage(),
                    'lastPage'    => $data->lastPage(),
                    'application' => $application,
                    'interview'   => $interview,
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Invalid Advertisement Post ID'
            ]);
        }
    }


    public function candidateShortlistProcess(Request $request)
    {
        // Step 1: valiadte request data
        $validated = $request->validate([
            'application' => 'required|array',
            'application.*' => 'integer|exists:nhidcl_recruitment_applications,id',
            'advertisementId' => 'required|exists:nhidcl_recruitment_advertisement,id',
            'postId' => 'required|exists:nhidcl_recruitment_posts,id',
            'remarks' => 'nullable|string|max:1000',
        ]);

        // Step 2: Update each application
        foreach ($validated['application'] as $applicationId) {
            $data = [
                'nhidcl_application_status_id' => '3',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id,
            ];

            $application = NhidclRecruitmentApplications::updateOrCreate(
                [
                    'id' => $applicationId,
                ],
                $data
            );

            // Timeline logic (prevent duplicate)
            $timelineExists = NhidclRecruitmentCandidateTimeline::where([
                'ref_users_id' => $application->ref_users_id,
                'nhidcl_recruitment_applications_id' => $applicationId,
                'nhidcl_application_status' => '3'
            ])->exists();

            if (!$timelineExists) {
                NhidclRecruitmentCandidateTimeline::create([
                    'ref_users_id' => $application->ref_users_id,
                    'nhidcl_recruitment_applications_id' => $applicationId,
                    'nhidcl_application_status' => '3',
                    'remarks' => $validated['remarks'] ?? 'Shortlisted by admin.',
                    'created_by' => auth()->user()->id,
                ]);
            }
        }
        Alert::success('Success', 'Candidate status shortlist updated successfully');
        return redirect()->route('recruitment-portal.selection.process');
    }

    public function candidateAssesmentProcess(Request $request)
    {
        // Step 1: valiadte request data
        $validated = $request->validate([
            'application' => 'required|array',
            'application.*' => 'integer|exists:nhidcl_recruitment_applications,id',
            'assesmentadsId' => 'required|exists:nhidcl_recruitment_advertisement,id',
            'assesment_post_id' => 'required|exists:nhidcl_recruitment_posts,id',
            'assesment' => 'required',
            'assesment_date' => 'required',
            'assesment_remarks' => 'nullable|string|max:1000',
        ]);
        // Step 2: Update each application
        foreach ($validated['application'] as $applicationId) {
            $data = [
                'nhidcl_application_status_id' => '4',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id,
            ];

            $application = NhidclRecruitmentApplications::updateOrCreate(
                [
                    'id' => $applicationId,
                ],
                $data
            );

            NhidclRecruitmentInterviews::create([
                'type' => $request->assesment,
                'nhidcl_recruitment_applications_id' => $applicationId,
                'nhidcl_application_status_id' => '10',
                'scheduled_at' => now(),
                'assesment_date' => $request->assesment_date,
                'remarks' => $request->assesment_remarks,
                'created_by' => auth()->user()->id,
            ]);

            // Timeline logic (prevent duplicate)
            $timelineExists = NhidclRecruitmentCandidateTimeline::where([
                'ref_users_id' => $application->ref_users_id,
                'nhidcl_recruitment_applications_id' => $applicationId,
                'nhidcl_application_status' => '4'
            ])->exists();

            if (!$timelineExists) {
                NhidclRecruitmentCandidateTimeline::create([
                    'ref_users_id' => $application->ref_users_id,
                    'nhidcl_recruitment_applications_id' => $applicationId,
                    'nhidcl_application_status' => '4',
                    'remarks' => $validated['assesment_remarks'] ?? 'Candidate assessment scheduled by admin.',
                    'created_by' => auth()->user()->id,
                ]);
            }
        }
        Alert::success('Success', 'Candidate assessment scheduled successfully');
        return redirect()->route('recruitment-portal.selection.process');
    }

    public function candidateInterviewStatus(Request $request)
    {
        // Step 1: valiadte request data
        $validated = $request->validate([
            'interview_id' => 'required|exists:nhidcl_recruitment_interviews,id',
            'status_id' => 'required',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $interview = NhidclRecruitmentInterviews::findOrFail($validated['interview_id']);
        // Don't allow status update if already Passed or Failed
        if (in_array($interview->nhidcl_application_status_id, [11, 12])) {
            return response()->json([
                'status' => false,
                'message' => 'This interview status is already finalized and cannot be changed.'
            ], 403);
        }

        $interview->nhidcl_application_status_id = $validated['status_id'];
        $interview->updated_by = auth()->user()->id;
        $interview->updated_at = now();
        $interview->save();

        $application = NhidclRecruitmentApplications::find($interview->nhidcl_recruitment_applications_id);
        if ($validated['status_id'] == "12") {
            $application->nhidcl_application_status_id = '6';
            $application->updated_by = auth()->user()->id;
            $application->updated_at = now();
            $application->save();
        }
        // Timeline logic (prevent duplicate)
        $timelineExists = NhidclRecruitmentCandidateTimeline::where([
            'ref_users_id' => $application->ref_users_id,
            'nhidcl_recruitment_applications_id' => $application->id,
            'nhidcl_application_status' => $validated['status_id']
        ])->exists();

        if (!$timelineExists) {
            NhidclRecruitmentCandidateTimeline::create([
                'ref_users_id' => $application->ref_users_id,
                'nhidcl_recruitment_applications_id' => $application->id,
                'nhidcl_application_status' => $validated['status_id'],
                'remarks' => $validated['remarks'] ?? 'Candidate assessment status updated by admin.',
                'created_by' => auth()->user()->id,
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Candidate interview status updated successfully.'
        ]);
    }

    public function candidateApplicationStatus(Request $request)
    {
        // Step 1: valiadte request data
        $validated = $request->validate([
            'application_id' => 'required|integer|exists:nhidcl_recruitment_applications,id',
            'status_id' => 'required|integer',
            'remarks' => 'required|string',
            'joining_date' => 'required_if:status_id,7|date',
            'offer_letter' => 'required_if:status_id,7|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $application = NhidclRecruitmentApplications::findOrFail($validated['application_id']);
        if ($request->hasFile('offer_letter')) {
            $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'doc', 'docx'];
            $path = storeMedia($request, 'uploads/recruitment/advertisement/', $ext, 'offer_letter');
            $data = $path->getData(true); // returns associative array
            $fileName = $data['file_name'];
            $filePath = "uploads/recruitment/advertisement/";
        }
        $application->nhidcl_application_status_id = $validated['status_id'];
        $application->updated_by = auth()->user()->id;
        $application->updated_at = now();
        $application->save();

        if ($validated['status_id'] == 7) {
            NhidclRecruitmentOfferLetter::create([
                'nhidcl_recruitment_applications_id' => $application->id,
                'offer_letter_file' => $fileName,
                'offer_letter_path' => $filePath,
                'date_of_joining' => $validated['joining_date'],
                'released_at' => now(),
                'nhidcl_application_status_id' => '13',
                'created_by' => auth()->user()->id,
            ]);
        }

        // Timeline logic (prevent duplicate)
        $timelineExists = NhidclRecruitmentCandidateTimeline::where([
            'ref_users_id' => $application->ref_users_id,
            'nhidcl_recruitment_applications_id' => $application->id,
            'nhidcl_application_status' => $validated['status_id']
        ])->exists();

        if (!$timelineExists) {
            NhidclRecruitmentCandidateTimeline::create([
                'ref_users_id' => $application->ref_users_id,
                'nhidcl_recruitment_applications_id' => $application->id,
                'nhidcl_application_status' => $validated['status_id'],
                'remarks' => $validated['remarks'] ?? 'Candidate application status updated by ' . auth()->user()->name,
                'created_by' => auth()->user()->id,
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Candidate application status updated successfully.'
        ]);
    }

    public function storeUpload_cover_photo(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('advertisement_file')) {
                    return storeMedia($request, 'uploads/recruitment/advertisement/', $ext, 'advertisement_file');
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
            Alert::error('error', 'Sorry, the file you are trying to access is unavailable.');
            return redirect()->route('recruitment-portal.advertisement.index');
        }
    }

    public function advertisementApplicantData(Request $request)
    {
        if ($request->ajax()) {
            $advertisementId = $request->input('advertisementId');
            // $query = AdvertisementPost::with(['application']);
            // if (!empty($advertisementId)) {
            //     $query->where("nhidcl_recruitment_advertisement_id", $advertisementId);
            // }
            // $result = $query->get();
            $query = DB::table('nhidcl_recruitment_applications as ap')
            ->join('nhidcl_recruitment_posts as p', 'ap.nhidcl_recruitment_posts_id', '=', 'p.id')
            ->select(
                'p.id as post_id',
                'p.post_name',
                'p.total_vacancy',
                'p.last_datetime',
                DB::raw('COUNT(ap.id) as applied_count')
            )
            ->when($advertisementId, function ($q) use ($advertisementId) {
                $q->where('ap.nhidcl_recruitment_advertisement_id', $advertisementId);
            })
            ->where('ap.action', 'submit')     // match Eloquent filter
            ->whereNull('ap.deleted_at')       // exclude soft-deleted applications
            ->whereNull('p.deleted_at')        // exclude soft-deleted posts
            ->groupBy('p.id', 'p.post_name', 'p.total_vacancy', 'p.last_datetime')
            ->orderBy('p.id')
            ->get();


            return response()->json([
                'status' => true,
                'data' => $query
            ]);
        }
    }

    public function updateApplicationStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'remarks' => 'nullable|max:500',
                'application_id' => 'required|integer|exists:nhidcl_recruitment_applications,id',
                'attachment' => 'required|file|mimes:pdf,doc,docx|max:2048',
            ]);

            $recordApplication = NhidclRecruitmentApplications::findOrFail($validated['application_id']);

            // Save attachment
            $filename = null;
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/recruitment/attachments', $filename); // store in storage/app/public/attachments
            }

            // Save remarks and files in logs tables
            $applogs = NhidclRecruitmentApplicationsLogs::updateOrCreate(
                [
                    'nhidcl_recruitment_applications_id' => $validated['application_id'],
                ],
                [
                    'ref_users_id' => auth()->user()->id,
                    'status' => 'draft',
                    'comment' => $validated['remarks'] ?? null,
                    'upload_file' => $filename,
                    'upload_file_path' => 'public/recruitment/attachments/',
                    'created_by' => auth()->user()->id,
                ]
            );

            // Update status (example)
            $recordApplication->display_time = Carbon::now()->addHours(72);
            $recordApplication->action = 'draft';
            $recordApplication->save();
            
            $applicationId = "NHIDCL/".date('Y')."/".$recordApplication->nhidcl_recruitment_posts_id."/".$recordApplication->ref_users_id;
            $recipient = User::findOrFail($recordApplication->ref_users_id);
            $myEmail = 'recruitment.nhidcl@nhidcl.com'; // replace with your email

            Mail::send('emails.application_update', [
                'user'          => auth()->user(),
                'applicationId' => $applicationId,
            ], function ($message) use ($applicationId, $recipient, $myEmail) {
                $message->to($recipient->email)
                    ->cc($myEmail) // Add CC here
                    ->subject("Application Edit Permission - NHIDCL Recruitment Portal");
            });
            // Return JSON success response
            return response()->json([
                'status' => 'success',
                'message' => 'Application updated successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json([
                'status' => 'error',
                'message' => $e->errors(), // returns array of errors
            ], 422);
        } catch (\Exception $e) {
            // Return general error
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function applicationLogsData(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $data = NhidclRecruitmentApplicationsLogs::query()->with('application')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('createdate', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y h:i:s') : null;
                })
                ->addColumn('status', function ($row) {
                    return $row->status ? ucwords($row->status) : 'Draft';
                })
                ->addColumn('viewfile', function ($row) {
                    $filePath = 'app/public/recruitment/attachments/' . $row->upload_file; // path relative to storage/app/public
                    $url = asset('storage/' . $filePath);
                    
                    // Default link for View Files (always visible)
                    if(empty($row->upload_file)){
                        $actionBtn = '';
                    }else{
                        $actionBtn = '<a href="' . $url . '" target="_blank">View Files</a>';
                    }
                    
                    // Check if the status is "submit" to show "Updated Files"
                    if ($row->status == "submit") {
                        $updatedFileUrl = route('recruitment-portal.candidate.application.profile', [
                            'pid' => $row?->application?->nhidcl_recruitment_posts_id,
                            'id' => Crypt::encryptString((string) $row?->application?->ref_users_id)
                        ]);
                        $actionBtn .= ' | <a href="' . $updatedFileUrl . '" target="_blank">Updated Files</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['createdate', 'status', 'viewfile'])
                ->make(true);
        }
        $logdata = NhidclRecruitmentApplicationsLogs::all();
        return view("recruitment-management.activity-log", compact("header", "sidebar", "logdata"));
    }

    public function applicationLogsExport(){
        $data = NhidclRecruitmentApplicationsLogs::orderBy('id')->get();
        return Excel::download(new ApplicantLogDataExport($data), 'applicant-activity-log-report.xlsx');
    }
}