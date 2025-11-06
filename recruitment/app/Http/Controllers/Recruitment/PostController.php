<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\NhidclRecruitmentPostGateDiscipline;
use App\Models\Recruitment\NhidclRecruitmentPostGateExam;
use App\Models\RefGateDiscipline;
use App\Models\RefPassingYear;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Recruitment\Advertisement;
use App\Models\RefMonth;
use App\Models\RefYear;
use App\Models\RefState;
use App\Models\RefQualification;
use App\Models\RefCourse;
use App\Models\User;
use App\Models\Recruitment\AdvertisementPost;
use App\Http\Requests\Recruitment\AdvertisementPostRequest;
use App\Models\RefModeOfRecruitment;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Recruitment-User|HR-Recruitment');
    }

    public function index(Request $request)
    {

        $header = TRUE;
        $sidebar = TRUE;

        if ($request->ajax()) {
           $data = AdvertisementPost::query()->orderBy('id', 'desc');
            // Apply filter only if request has filter_advertisement
            if (request()->has('filter_advertisement') && !empty(request('filter_advertisement'))) {
                $filter = request('filter_advertisement');

                // Example: filter by title or description field
                $data->where(function($q) use ($filter) {
                    $q->where('nhidcl_recruitment_advertisement_id', $filter);
                });
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('createdate', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y h:i:s') : null;
                })
                ->addColumn('createdby', function ($row) {
                    if (!is_null($row->created_by)) {
                        $username = User::find($row->created_by)->name;
                    } else {
                        $username = '';
                    }
                    return $username;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';

                    $editUrl = route('recruitment-portal.post.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('recruitment-portal.post.destroy', Crypt::encrypt($row->id));

                    // Edit button
                    $btn .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a> ';

                    // Delete button using form
                    $btn .= '<a  class="btn btn-danger btn-sm" href="javascript:void(0)" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>';
                    $btn .= '<form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';

                    return $btn;
                })
                ->rawColumns(['createdate', 'createdby', 'action'])
                ->make(true);
        }

        $year = Advertisement::pluck('created_at')->map(function ($date) {
            return $date->year; // Extracts the year from the date
        })->unique();

        $adslist = Advertisement::orderBy('id', 'DESC')->get();

        $monthList = RefMonth::orderBy('month')->get();
        $yearList = RefYear::orderBy('year')->get();
        $stateList = RefState::orderBy('name')->get();
        $gate_years = RefPassingYear::orderBy('passing_year', 'desc')->take(10)->get();
        $gate_disciplines = RefGateDiscipline::orderBy('discipline_name')->get();
        $refQualification = RefQualification::all();
        $refCourse = RefCourse::all();
        $refModeRecruitment = RefModeOfRecruitment::all();
        return view('recruitment-management.recruitment-post.index', compact('header', 'sidebar', 'gate_years', 'gate_disciplines', 'adslist', 'year', 'monthList', 'yearList', 'stateList', 'refQualification', 'refCourse', 'refModeRecruitment'));
    }

    public function store(AdvertisementPostRequest $request)
    {

        try {
            $age_limit = [
                'min_age_limit' => $request->min_age_limit,
                'max_age_limit' => $request->max_age_limit,
            ];
            
            $array = [
                'mode_of_requirement' => $request->mode_of_requirement,
                'advertisement_year' => $request->advertisement_year,
                'nhidcl_recruitment_advertisement_id' => (int) $request->recruitment_advertisement_id,
                'post_name' => $request->post_name,
                'is_active' => $request->is_active,
                'total_vacancy' => $request->total_vacancy,
                'age_limit' => json_encode($age_limit),
                'required_experience' => $request->required_experience,
                'required_gate_detail' => $request->required_gate_detail,
                'last_datetime' => $request->last_datetime,
                'created_by' => Auth::user()->id,
                "post_payment_type" => $request->post_payment_type,
                "amount" =>  ($request->post_payment_type === 'Paid') ? (float) $request->input('amount', 0) : null,
            ];
            
            $post = AdvertisementPost::create($array);
            // $locationArr = [];
            // if ($request->is_location_preference == 1) {
            //     $locatioin_prefered = $request->require_location_prefered;
            //     foreach ($locatioin_prefered as $val) {
            //         $locationArr[] = [
            //             'nhidcl_recruitment_posts_id' => $post->id,
            //             'ref_state_master_id' => $val,
            //         ];
            //     }
            //     PostLocation::insert($locationArr);
            // }

            if ($request->required_gate_detail == 1) {
                $gateYears = $request->required_gate_exam_year;
                $gateDisciplines = $request->required_gate_discipline;
                $yearArr = [];
                $disciplineArr = [];
                foreach ($gateYears as $val) {
                    $yearArr[] = [
                        'nhidcl_recruitment_posts_id' => $post->id,
                        'ref_passing_year_id' => $val,
                    ];
                }
                NhidclRecruitmentPostGateExam::insert($yearArr);

                foreach ($gateDisciplines as $val) {
                    $disciplineArr[] = [
                        'nhidcl_recruitment_posts_id' => $post->id,
                        'ref_gate_discipline_id' => $val,
                    ];
                }
                NhidclRecruitmentPostGateDiscipline::insert($disciplineArr);
            }

            // $desire_education = $request->desire_education;
            // $educationArray[] = [
            //     'nhidcl_recruitment_posts_id' => $post->id,
            //     'ref_qualification_id' => $desire_education,
            // ];
            // PostEducation::insert($educationArray);

            // $desire_course = $request->desire_experience;
            // $courseArray = [];
            // foreach($desire_course as $val){
            //     $courseArray[] = [
            //         'nhidcl_recruitment_posts_id' => $post->id,
            //         'ref_course_id' => $val,
            //     ];
            // }
            // PostCourse::insert($courseArray);
            Alert::success('Success', 'Submitted Successfully');
            return redirect()->route('recruitment-portal.post.index');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return redirect()->route('recruitment-portal.post.index')->with('error', $msg);
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $header = TRUE;
        $sidebar = TRUE;

        $edit_record = AdvertisementPost::with('getPostLocation', 'getPostQulification', 'getPostCourse', 'gateExamYears', 'gateDisciplines')->where('id', $id)->first();

        $edit_record->required_gate_exam_year = $edit_record->gateExamYears->pluck('ref_passing_year_id')->toArray();
        $edit_record->required_gate_discipline = $edit_record->gateDisciplines->pluck('ref_gate_discipline_id')->toArray();

        $age_limit = json_decode($edit_record->age_limit);
        $year = Advertisement::pluck('created_at')->map(function ($date) {
            return $date->year; // Extracts the year from the date
        })->unique();

        $monthList = RefMonth::orderBy('month')->get();
        $yearList = RefYear::orderBy('year')->get();
        $stateList = RefState::orderBy('name')->get();
        $gate_years = RefPassingYear::orderBy('passing_year', 'desc')->take(10)->get();
        $gate_disciplines = RefGateDiscipline::orderBy('discipline_name')->get();
        $refQualification = RefQualification::all();
        $refCourse = RefCourse::all();
        $advertisement = Advertisement::all();
        $note_instruction = json_decode($edit_record->note_instruction);
        $adslist = Advertisement::orderBy('id', 'DESC')->get();
        $refModeRecruitment = RefModeOfRecruitment::all();
        return view('recruitment-management.recruitment-post.edit', compact('gate_disciplines', 'gate_years', 'adslist', 'age_limit', 'advertisement', 'edit_record', 'header', 'sidebar', 'year', 'monthList', 'yearList', 'stateList', 'refQualification', 'refCourse', 'note_instruction', 'refModeRecruitment'));
    }

    public function getAdvertisement(Request $request)
    {
        $year = $request->get('year');
        $data = Advertisement::whereYear('created_at', $year)->get();

        $option = '';
        $option .= '<select class="advertisement_data" name="nhidcl_recruitment_advertisement_id">';
        foreach ($data as $val) {
            $option .= '<option value="' . $val->id . '">' . $val->advertisement_title . '</option>';
        }
        $option .= '</select>';

        return $option;
    }

    public function update($id, AdvertisementPostRequest $request)
    {
        try {
            $age_limit = [
                'min_age_limit' => $request->min_age_limit,
                'max_age_limit' => $request->max_age_limit,
            ];
            $array = [
                'mode_of_requirement' => $request->mode_of_requirement,
                'advertisement_year' => $request->advertisement_year,
                'nhidcl_recruitment_advertisement_id' => (int) $request->recruitment_advertisement_id,
                'post_name' => $request->post_name,
                'is_active' => $request->is_active,
                'total_vacancy' => $request->total_vacancy,
                'required_gate_detail' => $request->required_gate_detail,
                'age_limit' => json_encode($age_limit, true),
                'required_experience' => $request->required_experience,
                'last_datetime' => $request->last_datetime,
                'post_payment_type' => $request->post_payment_type,
                'amount' =>  ($request->post_payment_type === 'Paid') ? (float) $request->input('amount', 0) : null,
            ];
            AdvertisementPost::where('id', $id)->update($array);
            $post = AdvertisementPost::where('id', $id)->first();

            if ($request->required_gate_detail == 1) {
                $gateYears = $request->required_gate_exam_year;
                $gateDisciplines = $request->required_gate_discipline;
                
                // Delete existing records
                NhidclRecruitmentPostGateExam::where('nhidcl_recruitment_posts_id', $post->id)->delete();
                NhidclRecruitmentPostGateDiscipline::where('nhidcl_recruitment_posts_id', $post->id)->delete();
                
                // Insert new records
                $yearArr = [];
                $disciplineArr = [];
                
                foreach ($gateYears as $val) {
                    $yearArr[] = [
                        'nhidcl_recruitment_posts_id' => $post->id,
                        'ref_passing_year_id' => $val,
                    ];
                }
                NhidclRecruitmentPostGateExam::insert($yearArr);

                foreach ($gateDisciplines as $val) {
                    $disciplineArr[] = [
                        'nhidcl_recruitment_posts_id' => $post->id,
                        'ref_gate_discipline_id' => $val,
                    ];
                }
                NhidclRecruitmentPostGateDiscipline::insert($disciplineArr);
            } else {
                // Remove records if required_gate_detail is not 1
                NhidclRecruitmentPostGateExam::where('nhidcl_recruitment_posts_id', $post->id)->delete();
                NhidclRecruitmentPostGateDiscipline::where('nhidcl_recruitment_posts_id', $post->id)->delete();
            }

            Alert::success('Success', 'Advertisement post update successfully');
            return redirect()->route('recruitment-portal.post.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $msg = $e->getMessage();
            return redirect()->route('recruitment-portal.post.index')->with('error', $msg);
        }
    }

    public function destroy(string $id)
    {
        try {
            $adspost = AdvertisementPost::find(Crypt::decrypt($id));
            
            if (!$adspost) {
                Alert::error('Error', 'Advertisement post not found.');
                return redirect()->route('recruitment-portal.post.index');
            }
            
            // Use soft delete instead of permanent delete
            $adspost->delete(); // This will now soft delete
            
            Alert::success('Success', 'Advertisement post moved to trash successfully');
            return redirect()->route('recruitment-portal.post.index');
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Alert::error('Error', 'Invalid post identifier.');
            return redirect()->route('recruitment-portal.post.index');
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Operation failed due to a server error. Please retry.');
            return redirect()->route('recruitment-portal.post.index');
        }
    }
}
