<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Requests\candidate\personalDetailsRequest;
use App\Models\RefApplicantPersonalDetails;
use App\Models\NhidclAplicantEducationDetails;
use App\Models\NhidclApplicantWorkExperienceDetails;
use App\Models\NhidclApplicantAdditionalDetails;
use App\Helper\storeMedia;
use App\Models\NhidclResourceRequisition;
use App\Models\NhidclUserStatus;
use App\Models\RequisitionQualification;
use App\Models\NhidclResourceAdvertisementCommitte;
use App\Models\DesignationMaster;






class HrController extends Controller
{

    public function applicantProfile()
    {
        $header = true;
        $sidebar = true;

        return view("hr.selection-process", compact("header", "sidebar"));
    }

    public function hrAdvertisement()
    {
        $header = true;
        $sidebar = true;
        $user = Auth::user();
        $qualifications = ref_qualification::select('*')->get();
        $DesignationEngagement = DesignationEngagement::select('*')->get();
        $EngagementYear = DB::table('engagement_year')->orderby('id')->get();
        $workExperienceYear = DB::table('work_experience_year')->orderby('id')->get();
        $WorkExperienceMonth = DB::table('work_experience_month')->orderby('id')->get();
        $discipline = DB::table('ref_discipline')->orderby('id')->get();
        $domain = DB::table('ref_domain')->orderby('id')->where('is_deleted', 'false')->get();
        $engagement = DB::table('ref_engagement')->get();


        //  dd($workExperienceYear, $WorkExperienceMonth);



        //  $committeeMembers = User::role(roles: 'INTERNAL COMMITTEE-MEMBER')->get();
        //dd($committeeMembers);
        return view("resource-pool.hrAdvertisement", compact("header", "sidebar", "qualifications", "workExperienceYear", "EngagementYear", "DesignationEngagement", "WorkExperienceMonth", "discipline", "domain", "engagement"));
    }

    public function storeUpload_cover_photo(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_for_efile_noting')) {
                    return storeMedia($request, 'uploads/hr/upload_for_efile_noting/', $ext, 'upload_for_efile_noting');
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
            return redirect()->route('hr.viewFiles');
        }
    }

    public function create_requisition(Request $request)
    {
        $user = Auth::user();

        // dd($request->all());


        try {

            $validation = Validator::make($request->all(), [

                "Engagement" => 'required',
                "Designation_Engagement" => 'required',
                "number_of_required_resources" => 'required|numeric',
                "duration_of_engagement_start" => 'required',
                "duration_of_engagement_end" => 'required',
                "domain" => 'required',
                "discipline" => 'required',
                "qualification_requirements" => 'required',
                "minimum_work_experience" => 'required',
                "retired_government_personnel" => 'required',
                "comment" => 'required',
                "upload_for_efile_noting" => 'required|mimes:pdf,doc,docx'
            ]);

            //  $qualification_requirements =  implode(', ', $request->qualification_requirements);
            // dd($qualification_requirements);
            //dd($request->number_of_required_resources);
            if ($validation->fails()) {
                dd($validation);
                return redirect()->route('hr.create-requisition')->withErrors($validation)->withInput();
            }
            if ($request->duration_of_engagement_end != 12) {
                $duration_of_engagement_time = $request->duration_of_engagement_start . '.' . $request->duration_of_engagement_end;
            } else {
                $request->duration_of_engagement_end = 0;
            }



            try {

                $dataArr = [
                    "ref_independent_consultant_id" => (int) ($request->independent_consultant ?? 1),
                    //  "ref_independent_consultant_id" => (int) @$request->independent_consultant ? $request->independent_consultant : 1,
                    "ref_expert_professional_id" => (int) @$request->expert_professional ? $request->expert_professional : 1,
                    "ref_people_of_eminence_id" => (int) @$request->people_of_eminence ? $request->people_of_eminence : 1,
                    "number_of_required_resources" => (int) @$request->number_of_required_resources,
                    "duration_of_engagement_start" => @$duration_of_engagement_time,
                    "duration_of_engagement_end" => @$request->duration_of_engagement_end,
                    "ref_domain_id" => (int) @$request->domain ? $request->domain : 1,
                    "ref_discipline_id" => (int) @$request->discipline ? $request->discipline : 1,

                    "minimum_work_experience" => @$request->minimum_work_experience,
                    "retired_government_personnel" => @$request->retired_government_personnel,
                    "comment_box" => @$request->comment,
                    "upload_for_efile_noting" => @$request->upload_for_efile_noting_txt,
                    "created_at" => now(),
                    "created_by" => Auth::user()->id,
                    "job_title" => @$request->job_title,
                    "job_description" => @$request->job_description,
                    //  "ref_resource_requisition_id" => @$request->job_description,
                    "ref_engagement_id" => @$request->Engagement,
                    "nhidcl_engagement_designation_id" => @$request->Designation_Engagement,

                    //   "ref_chairperson_id" => @$request->chair_persone,
                ];




                // Retrieve the committee member IDs from the request





                $save = NhidclResourceRequisition::create($dataArr);
                //dd($save);
                //  dd($request->qualification_requirements);
                // $committeeMembers = $request->committee_members;
                $RequisitionQualification = [];
                foreach ($request->qualification_requirements as $qualification) {
                    //   dd($qualification);
                    RequisitionQualification::create([
                        "nhidcl_resource_requisition_id" => $save->id,
                        "ref_qualification_id" => $qualification,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ]);


                }

            } catch (\Exception $e) {
                dd($e);
                Alert::error('Error', 'Oops, something went wrong. Please try again later.');
                return redirect()->route('hr.create-requisition')->withInput()->withErrors(['msg' => $e->getMessage()]);
            }

            //$saved = RequisitionQualification::create($RequisitionQualification);



            //   $saved = RequisitionQualification::create($RequisitionQualification);
            //dd($saved);
            if ($save) {
                Alert::success('Success', 'Inserted Successfully');
                return redirect()->route('hr.create-requisition');
            } else {
                Alert::error('Error', 'Something went wrong');
                return redirect()->route('hr.create-requisition');
            }


            //  dd($dataArr);





        } catch (Exception $e) {
            //  dd($e);
            Alert::error('Error', 'Something went wrong, Please try again.');
            return redirect()->route('hr.create-requisition');
        }


    }

    public function postedJobs(Request $request)
    {
        try {
            $data = NhidclResourceRequisition::select('id', 'job_title', 'job_description', 'duration_of_engagement_start', 'duration_of_engagement_end', 'created_at', 'created_by')->get();
            return response()->json($data, 200);

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
        try {
            $data = NhidclResourceRequisition::with('creator')->select('id', 'job_title', 'job_description', 'duration_of_engagement_start', 'duration_of_engagement_end', 'created_at', 'created_by')->get();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    public function searchUsersByRole(Request $request)
    {

        // $UserId = Session::get('ref_user_id');



        //  $users = User::where('user_code', $UserId)->get();

        //     $users = User::whereNull('user_code')->paginate(10);


        //     $user_ref_id = User::select('id')->whereIn('id', function ($rowquery) {
        //         $rowquery->select('ref_users_id')
        //               ->from('nhidcl_user_status')
        //               ->where('ref_interview_status_id', 5);
        //     })->pluck('id')
        //     ->toArray();

        //   //  dd($users);
        //    //dd($user_ref_id);


        //    $sr_no = 1;


        //     $rows = '';
        //     if ($users->isEmpty()) {
        //         $rows .= '<tr><td colspan="3">No users found for this role.</td></tr>';
        //     } else {
        //         foreach ($users as $user) {
        //             // $roles = $user->roles->pluck('name')->implode(', ');
        //             $checked = in_array($user->id, $user_ref_id) ? 'checked' : '';
        //             $rows .= "<tr>
        //                        <td>{$sr_no}</td>
        //                        <td>{$user->id}</td>
        //                        <td>{$user->name}</td>
        //                        <td>Pending</td>
        //                        <td>
        //                        <a href='" . route('user.profile', $user->id) . "' class='btn btn-info'>View Profile</a>
        //                        </td>
        //                        <td><input type='checkbox' id='selected_{$user->id}' name='selected[]' value='{$user->id}' {$checked}></td>

        //                    </tr>";
        //                    $sr_no++;
        //         }
        //     }

        //     $paginationLinks = $users->onEachSide(2)->links('pagination::bootstrap-4')->render();
        //     return response()->json([
        //         'html' => $rows,
        //         'pagination' => $paginationLinks
        //     ]);


        if ($request->ajax()) {

            $users = User::whereNull('user_code')->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('user-config.show', Crypt::encrypt($row->id));


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

        // Render the view with the DataTables setup
        $header = TRUE;
        $sidebar = TRUE;

        return view('hr.selection-process', compact('header', 'sidebar'));
    }



    public function searchShortListedUsersByRole(Request $request)
    {
        // $query = User::whereHas('interviewStatus', function($query) {
        //     $query->where('status', 'SHORTLISTED');
        // });




        $user_ref_id = User::select('id')->whereIn('id', function ($rowquery) {
            $rowquery->select('ref_users_id')
                ->from('nhidcl_user_status')
                ->where('ref_interview_status_id', 5);
        })->pluck('id')
            ->toArray();
        //dd($user_ref_id);



        // $users->ref_id = $ref_users_id;
        // dd($users);

        if ($request->ajax()) {


            $query = "SELECT u.*,ris.status
            FROM ref_users u
            JOIN nhidcl_user_status us ON u.id = us.ref_users_id
            JOIN ref_interview_status ris ON us.ref_interview_status_id = ris.id
            WHERE ris.status = 'SHORTLISTED'";


            // $status = 'Shortlisted';  // Replace with the status you're searching for.

            $users = DB::select($query);



            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('user-config.show', Crypt::encrypt($row->id));


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
                    return $row->status;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
            }
            return view('hr.selection-process', compact('header', 'sidebar'));
    }

    public function updateUserStatus(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            'advertisement_id' => 'required|min:1',
            //  'user_ids.*' => 'integer|exists:ref_interview_status_id,User_id',
            //  'status' => 'required|string|in:active,inactive,suspended',
        ]);
        //  dd($request->user_ids);
        //  $userIds = $validated['user_ids'];

        $advertisement_id = $request->advertisement_id;
        // $status = $validated['status'];
        // dd($userIds);

        try {

            //  $updatedRows = NhidclUserStatus::whereIn(column: 'ref_users_id', $userIds)
            //      ->create(['ref_interview_status_id' => 5,'nhidcl_engagement_designation_id' => $advertisement_id]);
            //  dd($updatedRows);

            $RequisitionQualification = [];

            foreach ($request->user_ids as $user_id) {
                //   dd($qualification);
                NhidclUserStatus::create([

                    "nhidcl_resource_requisition_id" => $advertisement_id,
                    "ref_interview_status_id" => 5,
                    "ref_users_id" => $user_id,
                ]);

                $users = User::select('id')->whereIn('id', function ($query) {
                    $query->select('ref_users_id')
                        ->from('nhidcl_user_status')
                        ->where('ref_interview_status_id', 5);
                })->pluck('id');

                return response()->json(['selected_ids' => $users]);

                //dd($users,'hhhhhhhhhh');







                // $saved = NhidclUserStatus::create($RequisitionQualification);

            }
            //  dd($saved);


            //  $user = User::select('email')->where('id', $userIds)->first();

            // Mail::raw('Test email', function ($message) {
            //     $message->to($userEmail)
            //             ->subject('Test Subject');
            // });

            // Mail::raw('This is a test email body.', function ($message) use ($userEmail) {
            //     $message->to($userEmail)
            //             ->subject('Dear Candidate you are Shortlisted');
            // });
            // mail function
            // if ($user) {
            //     $emailAddress = $user->email;  // Get the email string

            //     Mail::raw('Dear Candidate you are Shortlisted', function ($message) use ($emailAddress) {
            //         $message->to($emailAddress)
            //             ->subject('Dear Candidate you are Shortlisted');
            //     });
            // } else {
            //     echo "User not found.";
            // }

            if ($RequisitionQualification > 0) {
                return response()->json(['message' => 'Users\' status updated successfully']);
            } else {
                return response()->json(['message' => 'No users were updated'], 400);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function showUserProfile($id)
    {

        $header = TRUE;
        $sidebar = TRUE;
        $users = User::find($id);

        if ($users) {
            return view('hr.CandidateUserData', compact('users', 'header', 'sidebar'));
        } else {
            echo "User not found.";
        }
    }

    public function SelectDatabyAdvertisement()
    {

    }

    public function HrApplicantProfile($id)
    {

        $header = true;
        $sidebar = true;
        $user = User::select('*')->where('id', $id)->get();
        // dd($user);
        if (auth()->user()->hasRole('HR Resource Pool')) {

            return view("hr.CandidateUserData", compact("header", "sidebar"));
        }
        // if(auth()->user()->hasRole('HR Resource Pool') $$ ){
        //  //   return view("applicantProfile", compact("header", "sidebar"));
        // }

    }

    public function HrCandidateDetails($id = null)
    {


        $header = true;
        $sidebar = true;

        // $Data['data']=RefApplicantPersonalDetails::where("ref_users_id",$id)->first();


        //  $Data['data']=NhidclAplicantEducationDetails::where("ref_users_id",$id)->get();


        //   $Data['data']=NhidclApplicantWorkExperienceDetails::where("ref_users_id",$id)->get();


        //   $Data['data']=NhidclApplicantAdditionalDetails::where("ref_users_id",$id)->get();

        // dd($id);
        $personal_details = RefApplicantPersonalDetails::where("ref_users_id", $id)->first();
        $educational_details = NhidclAplicantEducationDetails::where("ref_users_id", $id)->get();
        $experience_details = NhidclApplicantWorkExperienceDetails::where("ref_users_id", $id)->get();
        $additional_details = NhidclApplicantAdditionalDetails::where("ref_users_id", $id)->get();


        return view("hr.CandidateUserData", compact("header", "sidebar", "personal_details", "educational_details", "experience_details", "additional_details"));
    }

    public function generateShortlisted(Request $request)
    {

        $validated = $request->validate([

            'chairPersone_id' => 'required|min:1',
            'committieeMember_id' => 'required|array|min:1',
        ]);

        $chairPersone_id = $request->chairPersone_id;

        $committieeMember_ids = [];

        $lastInsertedId = DB::table('nhidcl_resource_requisition')->latest('id')->value('id');


        try {
            foreach ($request->committieeMember_id as $committieePember_ids) {

                NhidclResourceAdvertisementCommitte::create([

                    "ref_chairperson_id" => $chairPersone_id,
                    "ref_committe_id" => $committieePember_ids,
                    "nhidcl_resource_requisition_id" => $lastInsertedId,

                ]);

            }


        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }

        /*    $committeeMembers = $request->committee_members;
               $advertisementId = 6;

               // Prepare data for insertion

               $data = [];

               RequisitionQualification
               foreach ($committeeMembers as $memberId) {
                   $data[] = [
                      'nhidcl_resource_requisition_id' => $advertisementId,
                       'ref_committe_id' => $memberId,
                       'created_at' => now(),
                       'updated_at' => now(),
                   ];
               }

               DB::table('nhidcl_resource_advertisement_committe')->insert($data);
        */

    }


    public function ExternalCommittee()
    {
        return view('external-committee');
    }
    public function ExternalCommitteeStore(Request $request)
    {
        // dd($request);
        $request->role = 'EXTERNAL COMMITTEE-MEMBER';

        $request->validate([
            'externalMambername' => 'required|string|max:255',
            'externalMamberemail' => 'required|email',
            'externalMambermobile' => 'required|numeric|min_digits:10',
        ]);

        // Save the new external committee member to the database
        try {
            $user = User::create([
                'name' => $request->externalMambername,
                'email' => $request->externalMamberemail,
                'mobile' => $request->externalMambermobile,
                'password' => 'password123',
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
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
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
        ->get();

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
}
