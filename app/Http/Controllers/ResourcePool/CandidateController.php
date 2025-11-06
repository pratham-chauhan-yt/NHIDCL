<?php

namespace App\Http\Controllers\ResourcePool;

use App\Exports\ResourcePoolUserExport;
use App\Http\Controllers\Controller;
use App\Models\NhidclAplicantEducationDetails;
use App\Models\NhidclApplicantAdditionalDetails;
use App\Models\NhidclApplicantWorkExperienceDetails;
use App\Models\NhidclCompetitiveExams;
use App\Models\NhidclDisclouserQuestions;
use App\Models\NhidclTrainingCertificate;
use App\Models\RefApplicantPersonalDetails;
use App\Models\NhidclResourceRequisition;
use App\Models\RefBoardUniversityCollege;
use App\Models\RefWorkExperienceYear;
use App\Models\RefExam;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if ($user && $user->hasRole('Super Admin')) {
                abort(403, 'Unauthorized - Super Admin cannot access this page.');
            }
            return $next($request);
        });
    }

    public function view(Request $request)
    {   
        if ($request->ajax()) {
            if ($request->has('download') && $request->download == 'excel') {
                return $this->export($request);
            }

            $users = User::with('personalDetails', 'educationalDetails', 'workExperience', 'examData')->where('is_deleted', '!=', '1')
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'Resource Pool User');
                })
                ->select([
                    'id',
                    'name',
                    'email',
                    'mobile',
                    'date_of_birth',
                    'is_logged',
                    'status'
                ])
                ->with('roles');
            if ($request->has('search') && !empty($request->search['value'])) {
                $searchTerm = '%' . trim($request->search['value']) . '%';
 
                $users->where(function ($query) use ($searchTerm) {
                    $query->whereRaw('name ILIKE ?', [$searchTerm])
                        ->orWhereRaw('email ILIKE ?', [$searchTerm])
                        ->orWhereRaw('mobile ILIKE ?', [$searchTerm]);
                });
            }

            if ($request->has('email') && $request->email != '') {
                $users->whereRaw('email ILIKE ?', ['%' . trim($request->email) . '%']);
            }

            if ($request->has('dob') && $request->dob != '') {
                $dob = \Carbon\Carbon::createFromFormat('d-m-Y', $request->dob)->format('Y-m-d');
                $users->whereHas('personalDetails', function ($query) use ($dob) {
                    $query->whereDate('date_of_birth', $dob);
                });
            }
            if ($request->has('gender') && $request->gender != '') {
                $users->whereHas('personalDetails', function ($query) use ($request) {
                    $query->where('gender', 'like', '%' . $request->gender . '%');
                });
            }

            if ($request->has('board') && $request->board != '') {
                $users->whereHas('educationalDetails', function ($query) use ($request) {
                    $query->where('ref_board_university_college_id', 'like', '%' . $request->board . '%');
                });
            }

            if ($request->has('experience') && $request->experience != '') {
                $users->whereHas('workExperience', function ($query) use ($request) {
                    $query->where('ref_work_experience_year_id', 'like', '%' . $request->experience . '%');
                });
            }

            if ($request->has('exam') && $request->exam != '') {
                $users->whereHas('examData', function ($query) use ($request) {
                    $query->where('ref_exam_id', 'like', '%' . $request->exam . '%');
                });
            }

            if ($request->has('mobile') && $request->mobile != '') {
                $users->where('mobile', 'like', '%' . $request->mobile . '%');
            }

            if ($request->has('department') && $request->department != '') {
                $users->where('ref_department_id', (int)$request->department);
            }

            if ($request->has('role') && $request->role != '') {
                $users->whereHas('roles', function ($query) use ($request) {
                    $query->where('roles.id', $request->role); // Filter based on role ID
                });
            }
            $users = $users->orderBy('id', 'DESC')->get();
            
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row->id));
                    $editUrl = route('user-config.edit', Crypt::encrypt($row->id));

                    $actionBtn = '<a href="' . $showUrl . '" class="btn btn-info btn-sm">View</a>';

                    if (Gate::allows('user config - edit user'))
                        $actionBtn .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';

                    return $actionBtn;
                })
                ->editColumn('date_of_birth', function ($row) {
                    return !empty($row->date_of_birth)
                    ? \Carbon\Carbon::parse($row->date_of_birth)->format('d-m-Y')
                    : '';
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 'Active' || $row->status == '') ? 'Active' : 'Inactive';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        $university = RefBoardUniversityCollege::all();
        $experience = RefWorkExperienceYear::all();
        $exam = RefExam::all();
        return view('resource-pool.HR.listOfCandidates', compact('header', 'sidebar', 'university', 'experience', 'exam'));
    }

    public function show(Request $request, string $id)
    {
        $user = User::find(Crypt::decrypt($id));

        if ($request->ajax()) {
            try {
                $committeeShortlists = $user->shortlists()
                    ->with(['shortlistStatus', 'shortlistApplicantDetails'])
                    ->get();

                $chairpersonShortlists = $user->shortlistByChairperson()
                    ->with(['shortlistStatus', 'shortlistApplicantDetails'])
                    ->get();

                $finalShortlist = $user->finalShortlist()
                    ->get();

                $grouped = [];

                // Group committee data by requisition ID
                foreach ($committeeShortlists as $committee) {
                    $requisitionId = $committee->shortlistApplicantDetails->nhidcl_resource_requisition_id ?? null;

                    if (!$requisitionId) continue;

                    $requisitionName = NhidclResourceRequisition::find($requisitionId)->get('job_title')->first()->job_title ?? '';
                    $grouped[$requisitionId]['requisition_id'] = $requisitionId . ' - ' . $requisitionName;
                    $grouped[$requisitionId]['committee'][] = [
                        'status' => $committee->shortlistStatus->status ?? '-',
                        'remark' => $committee->remark ?? '-',
                    ];
                }

                // Attach chairperson data
                foreach ($chairpersonShortlists as $chairperson) {
                    $requisitionId = $chairperson->shortlistApplicantDetails->nhidcl_resource_requisition_id ?? null;

                    if (!$requisitionId) continue;

                    $grouped[$requisitionId]['chairperson'] = [
                        'status' => $chairperson->shortlistStatus->status ?? '-',
                        'remark' => $chairperson->remark ?? '-',
                    ];
                }

                // Attach final shortlist data
                foreach ($finalShortlist as $final) {
                    $requisitionId = $final->nhidcl_resource_requisition_id;
                    if (!$requisitionId) continue;
                    $grouped[$requisitionId]['final_shortlist'] = [
                        'status' => $final->status ?? '-',
                        'remark' => $final->remark ?? '-',
                    ];
                }

                $data['selection_details'] = collect($grouped)->values();

                $collection = collect($grouped)->values();

                return DataTables::of($collection)
                    ->addIndexColumn()
                    ->addColumn('committee_status', function ($row) {
                        return collect($row['committee'] ?? [])
                            ->pluck('status')
                            ->map(fn($s) => "<div>$s</div>")
                            ->implode('');
                    })
                    ->addColumn('committee_remark', function ($row) {
                        return collect($row['committee'] ?? [])
                            ->pluck('remark')
                            ->map(fn($r) => "<div>$r</div>")
                            ->implode('');
                    })
                    ->addColumn('chairperson_status', fn($row) => $row['chairperson']['status'] ?? '-')
                    ->addColumn('chairperson_remark', fn($row) => $row['chairperson']['remark'] ?? '-')
                    ->addColumn('final_shortlist_status', fn($row) => $row['final_shortlist']['status'] ?? '-')
                    ->addColumn('final_shortlist_remark', fn($row) => $row['final_shortlist']['remark'] ?? '-')
                    ->rawColumns(['committee_status', 'committee_remark']) // Allow HTML
                    ->make(true);
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => [],
                    'recordsFiltered' => 0,
                    'recordsTotal' => 0,
                ], 500);
            }
        }

        $data['personal_details']=RefApplicantPersonalDetails::where("ref_users_id",$user->id)->first();
        $data['educational_details']=NhidclAplicantEducationDetails::with("ref_passing_year","board_university_college","main_subject","course_mode","qualification","course")->where("ref_users_id",$user->id)->orderBy("created_at", "DESC")->get();
        $data['experience_details']=NhidclApplicantWorkExperienceDetails::with("post_held","job_type","area_experties", "work_experience")->where("ref_users_id",$user->id)->orderBy("created_at", "DESC")->get();
        $data['additional_details']=NhidclApplicantAdditionalDetails::where("ref_users_id",$user->id)->orderBy("created_at", "DESC")->get();
        $data['competitive_details']=NhidclCompetitiveExams::with('examDetails','appearingYear')->where("ref_users_id",$user->id)->orderBy("created_at", "DESC")->get();
        $data['training_details']=NhidclTrainingCertificate::where("ref_users_id",$user->id)->get();
        $data['disclouser_questions'] =NhidclDisclouserQuestions::where("ref_users_id",$user->id)->first();

        $header = true;
        $sidebar = true;
        return view('resource-pool.userDetails', compact('user','data', 'header', 'sidebar'));
    }

    public function exportPDF(string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(403, 'Invalid ID');
        }

        $user = User::findOrFail($userId);

        $data = [
            'personal_details'     => RefApplicantPersonalDetails::where("ref_users_id", $user->id)->first(),
            'educational_details'  => NhidclAplicantEducationDetails::with(['ref_passing_year', 'board_university_college', 'main_subject', 'course_mode', 'qualification', 'course'])
                                        ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'experience_details'   => NhidclApplicantWorkExperienceDetails::with(['post_held', 'job_type', 'area_experties', 'work_experience'])
                                        ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'additional_details'   => NhidclApplicantAdditionalDetails::where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'competitive_details'  => NhidclCompetitiveExams::with(['examDetails', 'appearingYear'])
                                        ->where("ref_users_id", $user->id)->orderBy("created_at", "DESC")->get(),
            'training_details'     => NhidclTrainingCertificate::where("ref_users_id", $user->id)->get(),
            'disclouser_questions' => NhidclDisclouserQuestions::where("ref_users_id", $user->id)->first(),
        ];

        $userPhoto = ($data['personal_details'] && $data['personal_details']->upload_photos_filepath && $data['personal_details']->upload_photos) ? viewFilePath($data['personal_details']->upload_photos_filepath) . $data['personal_details']->upload_photos : "";

        $userPhoto = file_exists($userPhoto) ? $userPhoto : "";

        $userSignature = ($data['personal_details'] && $data['personal_details']->upload_signature_filepath && $data['personal_details']->upload_signature) ? viewFilePath($data['personal_details']->upload_signature_filepath) . $data['personal_details']->upload_signature : "";

        $userSignature = file_exists($userSignature) ? $userSignature : "";

        $pdf = Pdf::loadView('resource-pool.pdfOfUserDetails', compact('data', 'user', 'userPhoto', 'userSignature'))
            ->setPaper('a4', 'portrait');

        return $pdf->download(Str::slug($user->name) . '_' . now()->format('Ymd_His') . '.pdf');
    }

    public function export(Request $request)
    {   
        
        $users = User::with('personalDetails', 'educationalDetails', 'workExperience', 'examData', 'department', 'employeeType')->where('is_deleted', '!=', '1')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Resource Pool User');
            });
        if ($request->has('email') && $request->email != '') {
            $users->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($request->email) . '%']);
        }
        if ($request->has('mobile') && $request->mobile != '') {
            $users->where('mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->has('dob') && $request->dob != '') {
            $dob = \Carbon\Carbon::createFromFormat('d-m-Y', $request->dob)->format('Y-m-d');
            $users->whereDate('date_of_birth', $dob);
        }
        if ($request->has('gender') && $request->gender != '') {
            $users->whereHas('personalDetails', function ($query) use ($request) {
                $query->where('gender', 'like', '%' . $request->gender . '%');
            });
        }
        if ($request->has('board') && $request->board != '') {
            $users->whereHas('educationalDetails', function ($query) use ($request) {
                $query->where('ref_board_university_college_id', 'like', '%' . $request->board . '%');
            });
        }

        if ($request->has('experience') && $request->experience != '') {
            $users->whereHas('workExperience', function ($query) use ($request) {
                $query->where('ref_work_experience_year_id', 'like', '%' . $request->experience . '%');
            });
        }

        if ($request->has('exam') && $request->exam != '') {
            $users->whereHas('examData', function ($query) use ($request) {
                $query->where('ref_exam_id', 'like', '%' . $request->exam . '%');
            });
        }

        $users=$users->orderBy('id', 'asc')->get();
        foreach ($users as $user) {
            $user->personal_details = RefApplicantPersonalDetails::where("ref_users_id", $user->id)->first();
            $user->educational_details = NhidclAplicantEducationDetails::with("ref_passing_year", "board_university_college", "main_subject", "course_mode", "qualification", "course")
                ->where("ref_users_id", $user->id)->get();
            $user->experience_details = NhidclApplicantWorkExperienceDetails::with("post_held", "job_type", "area_experties")
                ->where("ref_users_id", $user->id)->get();
            $user->additional_details = NhidclApplicantAdditionalDetails::where("ref_users_id", $user->id)->get();
            $user->competitive_details = NhidclCompetitiveExams::with('examDetails', 'appearingYear')
                ->where("ref_users_id", $user->id)->get();
            $user->training_details = NhidclTrainingCertificate::where("ref_users_id", $user->id)->get();
            $user->disclosure_questions = NhidclDisclouserQuestions::where("ref_users_id", $user->id)->first();
        }
        return Excel::download(new ResourcePoolUserExport($users), 'ExportCandidateList.xlsx');
    }
}
