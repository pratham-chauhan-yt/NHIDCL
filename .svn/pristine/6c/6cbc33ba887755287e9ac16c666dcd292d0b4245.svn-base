<?php

namespace App\Http\Controllers\ResourcePool\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\ref_qualification;
use App\Models\DesignationEngagement;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistChairPerson;
use App\Models\RefApplicantPersonalDetails;
use App\Models\NhidclAplicantEducationDetails;
use App\Models\NhidclApplicantWorkExperienceDetails;
use App\Models\NhidclApplicantAdditionalDetails;
use App\Models\RefBoardUniversityCollege;
use App\Helper\storeMedia;
use App\Mail\NewUserSetPasswordMail;
use App\Models\NhidclResourceRequisition;
use App\Models\NhidclUserStatus;
use App\Models\RequisitionQualification;
use App\Models\NhidclResourceAdvertisementCommitte;
use App\Models\DesignationMaster;
use App\Models\RefDomain;
use App\Models\RefDiscipline;
use App\Models\RefEngagement;
use App\Models\RefWorkExperienceMonth;
use App\Models\RefWorkExperienceYear;
use App\Models\RefEngagementYear;
use Illuminate\Support\Facades\Log;
use App\Models\RefAreaExperties;
use App\Models\RefCourseMode;
use App\Models\RefExam;
use App\Models\RefJobType;
use App\Models\RefPostHeld;
use App\Models\RefQualification;
use App\Models\RefCourse;
use App\Models\AdvertisementBasedUsers;
use App\Models\ResourcePool\NhidclResourceRequisitionShortlistApplicantDetail;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistHr;
use App\Models\ResourcePool\RefShortlistBy;
use App\Models\ResourcePool\RefShortlistStatus;
use App\Models\NhidclRequisitionCourse;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistCommittee;
use App\Models\NhidclBatches;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class HrController extends Controller
{

    public function selectionProcess(Request $request)
    {
        if ($request->ajax()) {
            $listOfRequisitions = collect();
            $requisitionYears = $request->requisitionYear ?? null;

            if ($requisitionYears) {
                $listOfRequisitions = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears])
                    ->select('id', 'job_title')
                    ->orderBy('id', 'asc')
                    ->get();
            } else {
                $requisitionYears = NhidclResourceRequisition::selectRaw('EXTRACT(YEAR FROM created_at) as year')
                    ->distinct()
                    ->orderBy('year', 'desc')
                    ->pluck('year');

                if ($requisitionYears->isNotEmpty()) {
                    $listOfRequisitions = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
                        ->select('id', 'job_title')
                        ->orderBy('id', 'asc')
                        ->get();
                }
            }

            return response()->json([
                'success' => !$listOfRequisitions->isEmpty(),
                'listOfRequisitions' => $listOfRequisitions,
            ]);
        }
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
                ->where("end_date", ">=", today()->format('Y-m-d'))
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

        $user_chairpersons = User::where(function ($query) {
            $query->whereHas('permissions', function ($subQuery) {
                $subQuery->where('name', 'resource pool - create chairperson shortlist');
            })
                ->orWhereHas('roles.permissions', function ($subQuery) {
                    $subQuery->where('name', 'resource pool - create chairperson shortlist');
                });
        })->where('is_nhidcl_employee', true)
            ->get();

        /********************Fetching Requison list selected by chairperson *********************** */
        $requisitionSelectedBYChairPerson = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
            ->where('is_deleted', false)
            ->whereHas('shortlistApplicantDetails', function ($query) {
                $query->where('ref_shortlist_by_id', 3)->where('is_deleted', false);
            })
            ->with([
                'shortlistApplicantDetails' => function ($query) {
                    $query->where('ref_shortlist_by_id', 3)
                        ->where('is_deleted', false)
                        ->orderBy('id', 'desc'); // Limits to only 1 record
                }
            ])
            ->distinct()
            ->get(['id', 'job_title']);

        /************************Batch bise selected candidate  ************************************ */
        $batchListed = NhidclBatches::where('is_deleted', false)->get();

        if (($user <> null) && $user->can(['resource pool - create HR shortlist', 'resource pool - view HR shortlist'])) {
            return view("resource-pool.HR.selection-process", compact("header", "sidebar", "user_chairpersons", "batchListed", "user_member", "courses", "courseModes", "qualifications", "exams", "areaExperties", "jobTypes", "posts", "experienceYears", "requisitionYears", "listOfRequisitions", "requisitionSelectedBYChairPerson"));
        }

        /********** */

    }

    public function selectionProcessManual(Request $request)
    {
        if ($request->ajax()) {
            $listOfRequisitions = collect();
            $requisitionYears = $request->requisitionYear ?? null;

            if ($requisitionYears) {
                $listOfRequisitions = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears])
                    ->select('id', 'job_title')
                    ->orderBy('id', 'asc')
                    ->get();
            } else {
                $requisitionYears = NhidclResourceRequisition::selectRaw('EXTRACT(YEAR FROM created_at) as year')
                    ->distinct()
                    ->orderBy('year', 'desc')
                    ->pluck('year');

                if ($requisitionYears->isNotEmpty()) {
                    $listOfRequisitions = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
                        ->select('id', 'job_title')
                        ->orderBy('id', 'asc')
                        ->get();
                }
            }

            return response()->json([
                'success' => !$listOfRequisitions->isEmpty(),
                'listOfRequisitions' => $listOfRequisitions,
            ]);
        }
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
                ->where("end_date", ">=", today()->format('Y-m-d'))
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

        $user_chairpersons = User::where(function ($query) {
            $query->whereHas('permissions', function ($subQuery) {
                $subQuery->where('name', 'resource pool - create chairperson shortlist');
            })
                ->orWhereHas('roles.permissions', function ($subQuery) {
                    $subQuery->where('name', 'resource pool - create chairperson shortlist');
                });
        })->where('is_nhidcl_employee', true)
            ->get();

        /********************Fetching Requison list selected by chairperson *********************** */
        $requisitionSelectedBYChairPerson = NhidclResourceRequisition::whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
            ->where('is_deleted', false)
            ->whereHas('shortlistApplicantDetails', function ($query) {
                $query->where('ref_shortlist_by_id', 3)->where('is_deleted', false);
            })
            ->with([
                'shortlistApplicantDetails' => function ($query) {
                    $query->where('ref_shortlist_by_id', 3)
                        ->where('is_deleted', false)
                        ->orderBy('id', 'desc'); // Limits to only 1 record
                }
            ])
            ->distinct()
            ->get(['id', 'job_title']);

        /************************Batch bise selected candidate  ************************************ */
        $batchListed = NhidclBatches::where('is_deleted', false)->get();
        $university = RefBoardUniversityCollege::all();
        $experience = RefWorkExperienceYear::all();
        $exam = RefExam::all();
        if (($user <> null) && $user->can(['resource pool - create HR shortlist', 'resource pool - view HR shortlist'])) {
            return view("resource-pool.HR.selection-process-manual", compact("header", "sidebar", "university", "experience", "exam", "user_chairpersons", "batchListed", "user_member", "courses", "courseModes", "qualifications", "exams", "areaExperties", "jobTypes", "posts", "experienceYears", "requisitionYears", "listOfRequisitions", "requisitionSelectedBYChairPerson"));
        }
    }

    public function selectionCandidateList(Request $request){
        if($request->ajax()){
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
                ->with('roles'); // Eager loading roles to optimize queries
            if ($request->has('search') && $request->search != '') {
                $searchTerm = '%' . $request->search . '%';

                $users->where(function ($query) use ($searchTerm) {
                    $query->where('email', 'like', $searchTerm)
                        ->orWhere('mobile', 'like', $searchTerm)
                        ->orWhere('name', 'like', $searchTerm);
                });
            }

            if ($request->has('email') && $request->email != '') {
                $users->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->has('dob') && $request->dob != '') {
                $users->whereHas('personalDetails', function ($query) use ($request) {
                    $query->where('date_of_birth', 'like', '%' . $request->dob . '%');
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
                    $actionBtn = '<input type="checkbox" class="select-input" name="selected[]" id="'.$row->id.'" data-id="'.$row->id.'" value="'.$row->id.'">';
                    return $actionBtn;
                })
                ->editColumn('status', function ($row) {
                    return $row->status ?? 'Active';
                })
                ->editColumn('status', function ($row) {
                    return $row->status ?? 'Active';
                })
                ->editColumn('date_of_birth', function ($row) {
                    return !empty($row->date_of_birth)
                    ? \Carbon\Carbon::parse($row->date_of_birth)->format('d-m-Y')
                    : '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function hrAdvertisement()
    {
        $header = true;
        $sidebar = true;
        $user = Auth::user();
        $qualifications = ref_qualification::select('*')->get();
        $DesignationEngagement = DesignationEngagement::select('*')->get();
        $minimumWorkExp = RefEngagementYear::get();
        $workExperienceYear = RefWorkExperienceYear::orderBy("id", "asc")->get();
        $WorkExperienceMonth = RefWorkExperienceMonth::orderBy("id", "asc")->get();
        $discipline = RefDiscipline::orderby('id')->get();
        $domain = RefDomain::orderby('id')->where('is_deleted', 'false')->get();
        $engagement = RefEngagement::get();
        $courses = RefCourse::orderBy('id', 'asc')->get();
        return view("resource-pool.HR.hrAdvertisement", compact("header", "sidebar", "qualifications", "courses", "workExperienceYear", "minimumWorkExp", "DesignationEngagement", "WorkExperienceMonth", "discipline", "domain", "engagement"));
    }

    public function storeUpload_cover_photo(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_for_efile_noting')) {
                    return storeMedia($request, 'uploads/hr/upload_for_efile_noting/', $ext, 'upload_for_efile_noting');
                }

                if ($request->hasFile('upload_newspaper_clip')) {
                    return storeMedia($request, 'uploads/hr/upload_newspaper_clip/', $ext, 'upload_newspaper_clip');
                }

                if ($request->hasFile('upload_offer_letter')) {
                    return storeMedia($request, 'uploads/hr/upload_offer_letter/', $ext, 'upload_offer_letter');
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
        dd($file);
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

    public function create_requisition(Request $request)
    {

        $user = Auth::user();
        try {

            $validation = Validator::make($request->all(), [
                "engagement_type" => 'required',
                "designation_engagement" => 'required',
                "engagement_year" => 'required',
                "engagement_month" => 'required',
                "qualification_requirements" => 'required',
                "minimum_work_experience" => 'required',
                "retired_government_personnel" => 'required',
                "start_date" => 'required',
                "end_date" => 'required',
            ]);

            if ($validation->fails()) {
                Alert::error('Error', 'Please insert all the fields');
                return redirect()->back()->withErrors($validation)->withInput();
            }

            try {
                //dd($request->all());
                if ($request->upload_for_efile_noting_txt) {
                    $e_file = extractFileDetails($request->upload_for_efile_noting_txt);
                    $upload_for_efile_noting = @$e_file["fileName"];
                    $upload_for_efile_noting_filepath = @$e_file["filePath"];
                }
                if ($request->upload_newspaper_clip_txt) {
                    $news_file = extractFileDetails($request->upload_newspaper_clip_txt);
                    $newspaper_clipping = @$news_file["fileName"];
                    $newspaper_clipping_filepath = @$news_file["filePath"];
                }
                $dataArr = [
                    "job_title" => @$request->job_title,
                    "job_description" => @$request->job_description,
                    "ref_independent_consultant_id" => (int) ($request->independent_consultant ? $request->independent_consultant : 1),
                    "ref_expert_professional_id" => (int) @$request->expert_professional ? $request->expert_professional : 1,
                    "ref_people_of_eminence_id" => (int) @$request->people_of_eminence ? $request->people_of_eminence : 1,
                    "ref_engagement_id" => @$request->engagement_type,
                    "nhidcl_engagement_designation_id" => @$request->designation_engagement,
                    "engagement_year" => (int) @$request->engagement_year,
                    "engagement_month" => (int) @$request->engagement_month,
                    "number_of_required_resources" => (int) @$request->number_of_required_resources,
                    "ref_domain_id" => (int) @$request->domain ? $request->domain : 1,
                    "ref_discipline_id" => (int) @$request->discipline ? $request->discipline : 1,
                    "qualification_percent" => (int) @$request->qualification_percent ? $request->qualification_percent : '',
                    "ref_work_experience_year_id" => @$request->minimum_work_experience,
                    "retired_government_personnel" => @$request->retired_government_personnel,
                    "comment_box" => @$request->comment,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
                    "upload_for_efile_noting" => @$upload_for_efile_noting,
                    "upload_for_efile_noting_filepath" => @$upload_for_efile_noting_filepath,
                    "newspaper_publication_date" => @$request->newspaper_publication_date,
                    "newspaper_clipping" => @$newspaper_clipping,
                    "newspaper_clipping_filepath" => @$newspaper_clipping_filepath,
                    "created_at" => now(),
                    "created_by" => Auth::user()->id,
                ];

                $save = NhidclResourceRequisition::create($dataArr);

                $RequisitionQualification = [];
                $courseList = [];
                if (strlen($request->course_list[0])) {
                    $courseList = array_unique(explode(",", $request->course_list[0]));
                }

                foreach ($request->qualification_requirements as $qualification) {
                    $courses = RefCourse::whereIn('id', $courseList)
                        ->where('ref_qualification_id', $qualification)
                        ->pluck('id');

                    if ($courses)
                        $courses = implode(",", json_decode($courses));
                    RequisitionQualification::create([
                        "nhidcl_resource_requisition_id" => $save->id,
                        "ref_qualification_id" => $qualification,
                        "created_at" => now(),
                        "updated_at" => now()
                    ]);
                    $courses = explode(",", $courses);
                    //dd($courses);
                    if (count($courses)) {
                        foreach ($courses as $courseRow) {
                            NhidclRequisitionCourse::create([
                                "nhidcl_resource_requisition_id" => $save->id,
                                "ref_course_id" => $courseRow,
                                "created_at" => now(),
                                "updated_at" => now()
                            ]);
                        }
                    }

                }

                if ($save) {
                    Alert::success('Success', 'Inserted Successfully');
                    return redirect()->back();
                } else {
                    Alert::error('Error', 'Something went wrong');
                    return redirect()->back();
                }

            } catch (\Exception $e) {
                Alert::error('Error', 'Oops, something went wrong. Please try again later.');
                return redirect()->back()->withInput()->withErrors(['msg' => $e->getMessage()]);
            }

        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->back();
        }


    }

    public function postedJobs(Request $request)
    {
        try {
            $data = NhidclResourceRequisition::select('id', 'end_date', 'job_title', 'job_description', 'engagement_year', 'engagement_month', 'created_at', 'created_by');
            if ($request->input('searchKey')) {
                $data = $data->where("job_title", 'like', '%' . $request->searchKey . '%');
            }
            if ($request->input('filterKey') && ($request->input('filterKey') == "Scheduled")) {
                $data = $data->where("start_date", ">", today()->format('Y-m-d'));
            }
            $data = $data->where("end_date", ">", today()->format('Y-m-d'))
                ->take($request->take ? $request->take : 9)
                ->get()
                ->map(function ($item) {
                    $item->encryptedId = Crypt::encrypt($item->id);
                    return $item;
                });
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function editPostedJobs(Request $request, $id)
    {

        try {
            $id = Crypt::decrypt($id);
            $edit = NhidclResourceRequisition::find($id);

            if ($edit) {
                $header = true;
                $sidebar = true;

                $requisition = NhidclResourceRequisition::where('id', $id)->first();
                $qualifications = ref_qualification::select('*')->get();
                $DesignationEngagement = DesignationEngagement::select('*')->get();
                $minimumWorkExp = RefEngagementYear::get();
                $workExperienceYear = RefWorkExperienceYear::get();
                $WorkExperienceMonth = RefWorkExperienceMonth::get();
                $discipline = RefDiscipline::orderby('id')->get();
                $domain = RefDomain::orderby('id')->where('is_deleted', 'false')->get();
                $engagement = RefEngagement::get();
                $courses = RefCourse::select('*')->orderBy('id', 'asc')->get();

                $existingQualifications = RequisitionQualification::where('nhidcl_resource_requisition_id', $id)
                    ->pluck('ref_qualification_id')
                    ->toArray();
                $existingCourses = NhidclRequisitionCourse::where('nhidcl_resource_requisition_id', $id)
                    ->pluck('ref_course_id')
                    ->toArray();
                //dd($existingCourses,$id);
                return view("resource-pool.HR.editHrAdvertisement", compact("header", "sidebar", "qualifications", "courses", "workExperienceYear", "minimumWorkExp", "DesignationEngagement", "WorkExperienceMonth", "discipline", "domain", "engagement", 'requisition', 'existingQualifications', 'existingCourses'));

            }

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function updatePostedJobs(Request $request, $id)
    {
        try {

            $edit = NhidclResourceRequisition::find($id);
            if ($edit) {
                $upload_for_efile_noting = "";
                $upload_for_efile_noting_filepath = "";
                $newspaper_clipping = "";
                $newspaper_clipping_filepath = "";

                if ($request->upload_for_efile_noting_txt) {
                    $e_file = extractFileDetails($request->upload_for_efile_noting_txt);
                    $upload_for_efile_noting = @$e_file["fileName"];
                    $upload_for_efile_noting_filepath = @$e_file["filePath"];
                }
                if ($request->upload_newspaper_clip_txt) {
                    $news_file = extractFileDetails($request->upload_newspaper_clip_txt);
                    $newspaper_clipping = @$news_file["fileName"];
                    $newspaper_clipping_filepath = @$news_file["filePath"];
                }
                $dataArr = [
                    "job_title" => @$request->job_title,
                    "job_description" => @$request->job_description,
                    // "ref_independent_consultant_id" => (int) ($request->independent_consultant ? $request->independent_consultant: 1),
                    // "ref_expert_professional_id" => (int) @$request->expert_professional ? $request->expert_professional : 1,
                    // "ref_people_of_eminence_id" => (int) @$request->people_of_eminence ? $request->people_of_eminence : 1,
                    "ref_engagement_id" => @$request->engagement_type,
                    "nhidcl_engagement_designation_id" => @$request->Designation_Engagement,
                    "engagement_year" => @$request->engagement_year,
                    "engagement_month" => @$request->engagement_month,
                    "number_of_required_resources" => (int) @$request->number_of_required_resources,
                    "ref_domain_id" => (int) @$request->domain ? $request->domain : 0,
                    "ref_discipline_id" => (int) @$request->discipline ? $request->discipline : 0,
                    "qualification_percent" => (int) @$request->qualification_percent ? $request->qualification_percent : 0,
                    "ref_work_experience_year_id" => @$request->minimum_work_experience,
                    "retired_government_personnel" => @$request->retired_government_personnel,
                    "comment_box" => @$request->comment,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
                    "upload_for_efile_noting" => @$upload_for_efile_noting,
                    "upload_for_efile_noting_filepath" => @$upload_for_efile_noting_filepath,
                    "newspaper_publication_date" => @$request->newspaper_publication_date,
                    "newspaper_clipping" => @$newspaper_clipping,
                    "newspaper_clipping_filepath" => @$newspaper_clipping_filepath,
                    "created_at" => now(),
                    "created_by" => Auth::user()->id,
                ];
                //dd($dataArr);

                try {
                    $update = $edit->update($dataArr);
                    $RequisitionQualification = [];
                    $courseList = [];

                    if (strlen($request->course_list[0])) {

                        $courseList = array_unique(explode(",", $request->course_list[0]));
                    }

                    foreach ($request->qualification_requirements as $qualification) {

                        $courses = RefCourse::whereIn('id', $courseList)
                            ->where('ref_qualification_id', $qualification)
                            ->pluck('id');

                        if ($courses)
                            $courses = implode(",", json_decode($courses));
                        if ($courses) {

                            $reqQualification = RequisitionQualification::where(["nhidcl_resource_requisition_id" => $edit->id, "ref_qualification_id" => $qualification])->first();

                            if ($reqQualification != null) {
                                $reqQualification->update([
                                    "nhidcl_resource_requisition_id" => $edit->id,
                                    "ref_qualification_id" => $qualification,
                                    "created_at" => now(),
                                    "updated_at" => now()
                                ]);
                            } else {
                                RequisitionQualification::create([
                                    "nhidcl_resource_requisition_id" => $edit->id,
                                    "ref_qualification_id" => $qualification,
                                    "created_at" => now(),
                                    "updated_at" => now()
                                ]);
                            }

                            $courses = explode(",", $courses);

                            if (count($courses)) {
                                foreach ($courses as $courseRow) {

                                    $courseData = NhidclRequisitionCourse::where(["nhidcl_resource_requisition_id" => $edit->id, "ref_course_id" => $courseRow])->first();

                                    if ($courseData != null) {
                                        $courseData->update([
                                            "nhidcl_resource_requisition_id" => $edit->id,
                                            "ref_course_id" => $courseRow,
                                            "created_at" => now(),
                                            "updated_at" => now()
                                        ]);
                                    } else {
                                        NhidclRequisitionCourse::create([
                                            "nhidcl_resource_requisition_id" => $edit->id,
                                            "ref_course_id" => $courseRow,
                                            "created_at" => now(),
                                            "updated_at" => now()
                                        ]);
                                    }
                                }
                            }
                        }

                    }

                    Alert::success('Success', 'Update Successfully');
                    return redirect()->back();
                } catch (\Exception $e) {
                    Log::error($e);
                    Alert::error('Error', 'Something went wrong');
                    return redirect()->back();
                }
            }


        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function viewPostedArchiveJobs(Request $request, $id)
    {
        try {

            $id = Crypt::decrypt($id);
            $data = NhidclResourceRequisition::find($id);
            return response()->json($data, 200);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function deletePostedJobs(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        try {
            $data = NhidclResourceRequisition::find($id);

            if ($data->delete()) {
                $nFile = checkFileExist($data->newspaper_clipping_filepath, $data->newspaper_clipping);
                $eFile = checkFileExist($data->upload_for_efile_noting_filepath, $data->upload_for_efile_noting);
                if ($nFile)
                    unlink($nFile);
                if ($eFile)
                    unlink($eFile);
                Alert::success('Success', 'Deleted Successfully');
                return redirect()->back()->with('success', 'Deleted Successfully');
            }

        } catch (\Exception $e) {

            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function archivedJobs(Request $request)
    {
        //dd($request->input('searchKey'));
        $data = NhidclResourceRequisition::with('creator')
            ->select('id', 'job_title', 'job_description', 'start_date', 'end_date', 'engagement_year', 'engagement_month', 'created_at', 'created_by');
        if ($request->input('searchKey')) {

            $data = $data->where("job_title", 'like', '%' . $request->searchKey . '%');
        }
        $data = $data->where("end_date", "<", today()->format('Y-m-d'))->take($request->take ? $request->take : 9)->get()
            ->map(function ($item) {
                // Encrypt the 'id' and assign it to 'encryptedId'
                $item->encryptedId = Crypt::encrypt($item->id);
                return $item;
            });
        return response()->json($data, 200);
    }


    public function searchUsersByRole(Request $request)
    {
        if ($request->ajax()) {
            try {
                // 1. Check whether user has permission to access this route/function.
                if (!Gate::any(['resource pool - create HR shortlist', 'resource pool - manage HR shortlist'])) {
                    return response()->json([
                        'data' => [],
                        'recordsFiltered' => 0,
                        'recordsTotal' => 0
                    ]);
                }

                // Fetch existing shortlist details
                $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where('nhidcl_resource_requisition_id', $request->postId)
                    ->whereIn('ref_shortlist_status_id', [1, 2])
                    ->where('ref_shortlist_by_id', 1)
                    ->where('is_deleted', false)
                    ->first();

                $users = collect(); // Initialize empty collection

                if ($existingShortlist) {
                    // Fetch all advertisement-based users with user relationship
                    $advertisementUsers = AdvertisementBasedUsers::with('user')
                        ->where('advertisement_id', $request->postId)
                        ->distinct('user_id');
                    
                    // Column-wise search
                    if (!empty($request->columns[5]['search']['value'])) {
                        $searchName = $request->columns[5]['search']['value'];
                        $advertisementUsers->whereHas('user', function ($q) use ($searchName) {
                            $q->where('name', 'like', "%{$searchName}%");
                        });
                    }

                    if (!empty($request->columns[5]['search']['value'])) {
                        $searchEmail = $request->columns[5]['search']['value'];
                        $advertisementUsers->whereHas('user', function ($q) use ($searchEmail) {
                            $q->where('email', 'like', "%{$searchEmail}%");
                        });
                    }

                    // if (!empty($request->columns[5]['search']['value'])) {
                    //     $searchStatus = $request->columns[5]['search']['value'];
                    //     $advertisementUsers->where('status', 'like', "%{$searchStatus}%");
                    // }

                    // Pagination
                    $recordsTotal = $advertisementUsers->count();
                    $advertisementUsers = $advertisementUsers->get();

                    // Fetch shortlisted candidates and map them by user ID
                    $shortlistedUsers = NhidclRequisitionApplicantShortlistHr::with('user')
                        ->where('nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id)
                        ->where('is_deleted', false)
                        ->distinct()
                        ->get()
                        ->keyBy('ref_users_id'); // Index by `ref_users_id` for fast lookup

                    // Merge data and assign selection status
                    $users = $advertisementUsers->map(function ($user) use ($shortlistedUsers) {
                        return [
                            'id' => $user->id,
                            'user_id' => optional($user->user)->id,  // Prevents accessing null values
                            'name' => optional($user->user)->name,
                            'email' => optional($user->user)->email,
                            'selected' => $shortlistedUsers->has(optional($user->user)->id), // Check if shortlisted
                        ];
                    });

                } else {
                    // if ($request->qualificationId || $request->courseId || $request->courseModeId || $request->minPercentage || $request->competitiveExamId || $request->minCompetitiveExamScore || $request->areaOfExpertiesId || $request->jobTypeId || $request->postId || $request->experienceYearId){

                    // }else{
                        // If no existing shortlist, return advertisement-based users only
                        $users = AdvertisementBasedUsers::with('user')
                            ->where('advertisement_id', $request->postId)
                            ->distinct('user_id')
                            ->get()
                            ->map(function ($user) {
                                return [
                                    'id' => $user->id,
                                    'user_id' => optional($user->user)->id,
                                    'name' => optional($user->user)->name,
                                    'email' => optional($user->user)->email,
                                    'selected' => false, // Default as false
                                ];
                            });
                    // }
                }

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        // $showUrl = route('user-config.show', Crypt::encrypt($row['user_id']));
                        $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row['user_id']));
                        return '<a href="'.$showUrl.'" class="action btn btn-default btn-sm">View</a>';
                    })
                    ->addColumn('checkbox', function ($row) use ($existingShortlist) {
                        return [
                            'checked' => $row['selected'],
                            'disabled' => ($existingShortlist && isset($existingShortlist->ref_shortlist_status_id))
                                ? $existingShortlist->ref_shortlist_status_id == 2
                                : false,
                        ];
                    })
                    ->editColumn('email', function ($row) {
                        return $row['email'] ?? '-';
                    })
                    ->editColumn('name', function ($row) {
                        return $row['name'] ?? '-';
                    })
                    ->editColumn('status', function ($row) {
                        return isset($row['status']) ? $row['status'] : '';
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => [],
                    'recordsFiltered' => 0,
                    'recordsTotal' => 0,
                    'error' => $th->getMessage() // Debugging purposes
                ], 500);
            }
        }


        return response()->json([
            'data' => [],
            'recordsFiltered' => 0,
            'recordsTotal' => 0
        ]);
    }

    public function searchCandidateByJob(Request $request)
    {
        if ($request->ajax()) {

            $users = User::whereNull('user_code')->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $showUrl = route('user-config.show', Crypt::encrypt($row->id));
                    $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row->id));

                    $actionBtn = '<a class="action" href="' . $showUrl . '" class="btn"><i class="fa fa-eye align-bottom text-success" title="View"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" name="selected[]" value="' . $row->id . '">';
                })
                ->editColumn('id', function ($row) {
                    return $row->id;
                })
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('status', function ($row) {
                    return $row->status ? $row->status : 'Pending';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;

        return view('resource-pool.HR.selection-process', compact('header', 'sidebar'));

    }

    public function searchShortListedUsersByRole()
    {
        // $query = User::whereHas('interviewStatus', function($query) {
        //     $query->where('status', 'SHORTLISTED');
        // });

        $query = "SELECT u.*,ris.status
                    FROM ref_users u
                    JOIN nhidcl_user_status us ON u.id = us.ref_users_id
                    JOIN ref_interview_status ris ON us.ref_interview_status_id = ris.id
                    WHERE ris.status = 'SHORTLISTED'";




        // $status = 'Shortlisted';  // Replace with the status you're searching for.

        $users = DB::select($query);

        // dd($users);

        $rows = '';
        if (empty($users)) {



            $rows .= '<tr><td colspan="3">No users found for this role.</td></tr>';
        } else {
            foreach ($users as $user) {


                $rows .= "<tr>
                            <td>{$user->id}</td>
                            <td>{$user->name}</td>
                            <td>{$user->status}</td>
                            <td>
                                <a href='" . route('user.profile', $user->id) . "' class='btn btn-info'>View Profile</a>
                            </td>
                            <td><input type='checkbox' id='selected_{$user->id}' name='selected[]' value='{$user->id}'></td>
                        </tr>";
            }
        }

        return response()->json(['html' => $rows]);// Return rows as HTML
    }

    public function updateUserStatus(Request $request)
    {

        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            'advertisement_id' => 'required|min:1',
        ]);


        $advertisement_id = $request->advertisement_id;


        try {

            $RequisitionQualification = [];

            foreach ($request->user_ids as $user_id) {
                NhidclUserStatus::create([

                    "nhidcl_resource_requisition_id" => $advertisement_id,
                    "ref_interview_status_id" => 5,
                    "ref_users_id" => $user_id,
                ]);

                // $saved = NhidclUserStatus::create($RequisitionQualification);

            }

            if ($RequisitionQualification > 0) {
                return response()->json(['message' => 'Users\' status updated successfully']);
            } else {
                return response()->json(['message' => 'No users were updated'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function showUserProfile($id)
    {

        $header = TRUE;
        $sidebar = TRUE;
        $users = User::find($id);

        if ($users) {
            return view('resource-pool.HR.CandidateUserData', compact('users', 'header', 'sidebar'));
        } else {
            echo "User not found.";
        }
    }

    public function HrApplicantProfile($id)
    {

        $header = true;
        $sidebar = true;
        $user = User::select('*')->where('id', $id)->get();

        if (auth()->user()->hasRole('HR Resource Pool')) {

            return view("resource-pool.HR.CandidateUserData", compact("header", "sidebar"));
        }


    }

    public function HrCandidateDetails($id = null)
    {


        $header = true;
        $sidebar = true;
        $id = Crypt::decrypt($id);
        $personal_details = RefApplicantPersonalDetails::where("ref_users_id", $id)->first();
        $educational_details = NhidclAplicantEducationDetails::where("ref_users_id", $id)->get();
        $experience_details = NhidclApplicantWorkExperienceDetails::where("ref_users_id", $id)->get();
        $additional_details = NhidclApplicantAdditionalDetails::where("ref_users_id", $id)->get();

        return route('user-config.show');
        //return view("resource-pool.HR.CandidateUserData", compact("header", "sidebar", "personal_details", "educational_details", "experience_details", "additional_details"));
    }

    public function generateShortlisted(Request $request)
    {
        try {
            DB::beginTransaction();
            $userId = Auth::user()->id;
            $candidates = collect($request->input('selectedUser', []))->mapWithKeys(function ($data, $candidateId) {
                return [
                    $candidateId => [
                        'selected' => filter_var($data['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                    ]
                ];
            })->toArray();
            $validation = Validator::make($request->all(), [
                'chairPersone_id' => 'required|min:1',
                'committieeMember_id' => 'required|array|min:1',
                //'externalMember'      => 'required|array|min:1',
            ]);
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput($request->all());
            }

            $committieeMember = $request->committieeMember_id ? $request->committieeMember_id : [];
            $externalMember = $request->externalMember ? $request->externalMember : [];
            if (is_array($externalMember) && is_array($committieeMember)) {
                $finalMember = array_merge($committieeMember, $externalMember);
            }


            /*************Creating Committee Member For This resource_requision_id */
            foreach ($finalMember as $committieeMember_id) {
                $isExist = NhidclResourceAdvertisementCommitte::where(['ref_committe_id' => $committieeMember_id, 'nhidcl_resource_requisition_id' => $request->resource_requision_id])
                    ->first();
                if (!$isExist) {
                    NhidclResourceAdvertisementCommitte::create([
                        "ref_committe_id" => $committieeMember_id,
                        "nhidcl_resource_requisition_id" => $request->resource_requision_id,
                        "created_by" => Auth::user()->id
                    ]);
                }
            }
            /*************Updating Chair person in Resource Requesion Table ******** */
            $chairPersone = NhidclResourceRequisition::find($request->resource_requision_id);
            $chairPersone->ref_chairperson_id = $request->chairPersone_id;
            $chairPersone->save();

            $shortListApplicatDetails = NhidclResourceRequisitionShortlistApplicantDetail::where("nhidcl_resource_requisition_id", $request->resource_requision_id)
                ->where("ref_shortlist_by_id", 1) // Shortlist by HR (1)
                ->first();

            if ($shortListApplicatDetails->ref_shortlist_status_id !== 1) {
                DB::rollBack();
                return response()->json(['message' => 'A shortlist already exists or is cancelled'], 500);
            }

            if (!$shortListApplicatDetails) {
                $shortListApplicatDetails = new NhidclResourceRequisitionShortlistApplicantDetail;
                $shortListApplicatDetails->created_by = $userId;
            }

            $shortListApplicatDetails->nhidcl_resource_requisition_id = $request->resource_requision_id;
            $shortListApplicatDetails->ref_shortlist_by_id = 1;
            $shortListApplicatDetails->ref_shortlist_status_id = 2;
            $shortListApplicatDetails->remarks = $request->remarks;
            $shortListApplicatDetails->updated_by = $userId;
            $shortListApplicatDetails->efile = @$request->efileCommittee;
            $shortListApplicatDetails->save();

            $existingSelectedCandidates = NhidclRequisitionApplicantShortlistHr::where(
                'nhidcl_resource_requisition_shortlist_applicant_details_id',
                $shortListApplicatDetails->id
            )->pluck('ref_users_id')->toArray();

            // Find candidates to delete (those in DB but not in the request)
            $candidatesToDelete = array_diff($existingSelectedCandidates, array_keys($candidates));

            // Update those candidates as deleted
            NhidclRequisitionApplicantShortlistHr::whereIn('ref_users_id', $candidatesToDelete)
                ->where('nhidcl_resource_requisition_shortlist_applicant_details_id', $shortListApplicatDetails->id)
                ->update(['is_deleted' => true]);

            // Insert or update incoming candidates
            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->save();
            }

            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->is_deleted = $data['selected'] ? false : true;
                $dataSelectHr->save();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function generateManualShortlisted(Request $request)
    {   
        try {
            DB::beginTransaction();
            $userId = Auth::user()->id;
            $candidates = collect($request->input('selectedUser', []))
                ->mapWithKeys(function ($candidateId) {
                    return [
                        $candidateId => [
                            'selected' => true, // all selected users are true
                        ],
                    ];
                })->toArray();
            $validation = Validator::make($request->all(), [
                'chairPersone_id' => 'required|min:1',
                'committieeMember_id' => 'required|array|min:1',
                //'externalMember'      => 'required|array|min:1',
            ]);
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput($request->all());
            }

            $committieeMember = $request->committieeMember_id ? $request->committieeMember_id : [];
            $externalMember = $request->externalMember ? $request->externalMember : [];
            $finalMember = array();
            if (is_array($externalMember) && is_array($committieeMember)) {
                $finalMember = array_merge($committieeMember, $externalMember);
            }

            /*************Creating Committee Member For This resource_requision_id */
            foreach ($finalMember as $committieeMember_id) {
                $isExist = NhidclResourceAdvertisementCommitte::where(['ref_committe_id' => $committieeMember_id, 'nhidcl_resource_requisition_id' => $request->resource_requision_id])
                    ->first();
                if (!$isExist) {
                    NhidclResourceAdvertisementCommitte::create([
                        "ref_committe_id" => $committieeMember_id,
                        "nhidcl_resource_requisition_id" => $request->resource_requision_id,
                        "created_by" => Auth::user()->id
                    ]);
                }
            }
            /*************Updating Chair person in Resource Requesion Table ******** */
            $chairPersone = NhidclResourceRequisition::find($request->resource_requision_id);
            $chairPersone->ref_chairperson_id = $request->chairPersone_id;
            $chairPersone->save();

            $shortListApplicatDetails = NhidclResourceRequisitionShortlistApplicantDetail::where("nhidcl_resource_requisition_id", $request->resource_requision_id)
                ->where("ref_shortlist_by_id", 1) // Shortlist by HR (1)
                ->first();

            // if ($shortListApplicatDetails->ref_shortlist_status_id !== 1) {
            //     DB::rollBack();
            //     return response()->json(['message' => 'A shortlist already exists or is cancelled'], 500);
            // }

            if (!$shortListApplicatDetails) {
                $shortListApplicatDetails = new NhidclResourceRequisitionShortlistApplicantDetail;
                $shortListApplicatDetails->created_by = $userId;
            }

            $shortListApplicatDetails->nhidcl_resource_requisition_id = $request->resource_requision_id;
            $shortListApplicatDetails->ref_shortlist_by_id = 1;
            $shortListApplicatDetails->ref_shortlist_status_id = 2;
            $shortListApplicatDetails->remarks = $request->remarks;
            $shortListApplicatDetails->updated_by = $userId;
            $shortListApplicatDetails->efile = @$request->efileCommittee;
            $shortListApplicatDetails->save();

            $existingSelectedCandidates = NhidclRequisitionApplicantShortlistHr::where(
                'nhidcl_resource_requisition_shortlist_applicant_details_id',
                $shortListApplicatDetails->id
            )->pluck('ref_users_id')->toArray();

            // Find candidates to delete (those in DB but not in the request)
            $candidatesToDelete = array_diff($existingSelectedCandidates, array_keys($candidates));

            // Update those candidates as deleted
            NhidclRequisitionApplicantShortlistHr::whereIn('ref_users_id', $candidatesToDelete)
                ->where('nhidcl_resource_requisition_shortlist_applicant_details_id', $shortListApplicatDetails->id)
                ->update(['is_deleted' => true]);

            // Insert or update incoming candidates
            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->remark = $request->remarks;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->save();
            }

            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->remark = $request->remarks;
                $dataSelectHr->is_deleted = $data['selected'] ? false : true;
                $dataSelectHr->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function saveDraft(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = Auth::user()->id;

            $candidates = collect($request->input('selectedUser', []))->mapWithKeys(function ($data, $candidateId) {
                return [
                    $candidateId => [
                        'selected' => filter_var($data['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                    ]
                ];
            })->toArray();

            $shortListApplicatDetails = NhidclResourceRequisitionShortlistApplicantDetail::where("nhidcl_resource_requisition_id", $request->resource_requision_id)
                ->where("ref_shortlist_by_id", 1) // Shortlist by HR (1)
                ->first();

            if ($shortListApplicatDetails && $shortListApplicatDetails->ref_shortlist_status_id !== 1) {
                DB::rollBack();
                return response()->json(['message' => 'A shortlist already exists or is cancelled'], 500);
            }

            if (!$shortListApplicatDetails) {
                $shortListApplicatDetails = new NhidclResourceRequisitionShortlistApplicantDetail;
                $shortListApplicatDetails->created_by = $userId;
            }

            $shortListApplicatDetails->nhidcl_resource_requisition_id = $request->resource_requision_id;
            $shortListApplicatDetails->ref_shortlist_by_id = 1;
            $shortListApplicatDetails->ref_shortlist_status_id = 1;
            $shortListApplicatDetails->remarks = $request->remarks;
            $shortListApplicatDetails->updated_by = $userId;
            $shortListApplicatDetails->efile = @$request->efileCommittee;
            $shortListApplicatDetails->save();

            $existingSelectedCandidates = NhidclRequisitionApplicantShortlistHr::where(
                'nhidcl_resource_requisition_shortlist_applicant_details_id',
                $shortListApplicatDetails->id
            )->pluck('ref_users_id')->toArray();

            // Find candidates to delete (those in DB but not in the request)
            $candidatesToDelete = array_diff($existingSelectedCandidates, array_keys($candidates));

            // Update those candidates as deleted
            NhidclRequisitionApplicantShortlistHr::whereIn('ref_users_id', $candidatesToDelete)
                ->where('nhidcl_resource_requisition_shortlist_applicant_details_id', $shortListApplicatDetails->id)
                ->update(['is_deleted' => true]);

            // Insert or update incoming candidates
            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->save();
            }

            foreach ($candidates as $candidateId => $data) {
                $dataSelectHr = NhidclRequisitionApplicantShortlistHr::firstOrNew([
                    'ref_users_id' => $candidateId,
                    'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortListApplicatDetails->id
                ]);

                $dataSelectHr->ref_users_id = $candidateId;
                $dataSelectHr->nhidcl_resource_requisition_shortlist_applicant_details_id = $shortListApplicatDetails->id;
                $dataSelectHr->created_by = $userId;
                $dataSelectHr->is_deleted = $data['selected'] ? false : true;
                $dataSelectHr->save();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }


    public function ExternalCommittee()
    {
        return view('external-committee');
    }
    public function ExternalCommitteeStore(Request $request)
    {
        $request->role = 'EXTERNAL COMMITTEE-MEMBER';

        $request->validate([
            'externalMemberName' => 'required|string|max:500',
            'externalMemberEmail' => 'required|email|unique:ref_users,email',
            'externalMemberMobile' => 'required|numeric|min:9',
        ]);

        // Save the new external committee member to the database
        try {
            $user = User::create([
                'name' => $request->externalMemberName,
                'email' => $request->externalMemberEmail,
                'mobile' => $request->externalMemberMobile,
                'password' => Str::random(12), // Temporary password, can be changed later
            ]);
            /***********Syncing role and parent Role with user */
            $request->role = 'EXTERNAL COMMITTEE-MEMBER';
            $roles = is_array($request->role) ? $request->role : [$request->role];

            $filteredRoles = array_filter($roles, function ($roleId) {
                $role = Role::findByName($roleId);
                return $role && $role->name !== 'Super Admin';
            });

            $rolesWithParentIds = array_map(function ($roleId) {
                $role = Role::findByName($roleId);
                $parentRoleId = $role ? $role->parent_role_id : null;
                return [
                    'role_id' => $role->id,
                    'parent_role_id' => $parentRoleId
                ];
            }, $filteredRoles);
            $user->syncRolesWithLogging($rolesWithParentIds);

            // Generate token and Send the reset link to the user's email
            $token = app('auth.password.broker')->createToken($user);
            Mail::to($user->email)->send(new NewUserSetPasswordMail($user, $token));

        } catch (\Exception $e) {
            //dd($e);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
        return response()->json(['message' => 'Users\' status updated successfully']);
    }

    public function fetchExternalMember()
    {
        $users = User::where(function ($query) {
            $query->whereHas('permissions', function ($subQuery) {
                $subQuery->where('name', 'resource pool - create committee shortlist');
            })
                ->orWhereHas('roles.permissions', function ($subQuery) {
                    $subQuery->where('name', 'resource pool - create committee shortlist');
                });
        })
            ->where('is_nhidcl_employee', false)
            ->get(['id', 'name', 'email']);

        return response()->json($users);
    }


    public function getDesignationsByEngagement($engagement_id)
    {

        $designations = DB::table('nhidcl_Designation_Engagement')
            ->where('ref_engagement_id', $engagement_id)
            ->select('id', 'designation')
            ->get();


        return response()->json($designations);
    }

    public function efileCommittee(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('efileCommittee')) {
                    return storeMedia($request, 'uploads/hr/efileCommittee/', $ext, 'efileCommittee');
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
}