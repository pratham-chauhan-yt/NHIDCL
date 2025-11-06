<?php

namespace App\Http\Controllers\ResourcePool\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistChairPerson;
use App\Models\NhidclResourceAdvertisementCommitte;
use App\Models\ResourcePool\NhidclResourceRequisitionShortlistApplicantDetail;
use App\Models\User;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistCommittee;
use DataTables;
use Crypt;
use Log;
use App\Models\NhidclBatches;
use App\Models\NhidclBatchCandidates;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class CandidateAssessmentController extends Controller
{
    public function fetchusersortlistedByChairperson(Request $request)
    {
        try {
            $reqData = explode("-", $request->input('requisitionId'));
            $request->requisitionId = (int) $reqData[0];
            $request->shortlistId = (int) $reqData[1];

            if (!$request->ajax() || !$request->requisitionId || !$request->shortlistId) {
                return response()->json([
                    'draw' => intval($request->draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'customMessage' => 'Invalid request data.',
                ]);
            }

            $userId = auth()->id();

            // Step 1A: Get all committee members for the requisition
            $committeeMembers = NhidclResourceAdvertisementCommitte::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['is_deleted', false]
            ])->pluck('ref_committe_id')->toArray();

            if (empty($committeeMembers)) {
                return response()->json([
                    'draw' => intval($request->draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'customMessage' => 'No committee members assigned to this requisition.',
                ]);
            }

            // Step 1B: Ensure all committee members have generated a shortlist
            $shortlistGenerated = NhidclResourceRequisitionShortlistApplicantDetail::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['ref_shortlist_by_id', 2], // Committee Shortlist
                ['ref_shortlist_status_id', 2], // Only check "Generated"
                ['is_deleted', false]
            ])->whereIn('created_by', $committeeMembers)->count();

            if ($shortlistGenerated < count($committeeMembers)) {
                return response()->json([
                    'draw' => intval($request->draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'customMessage' => 'Not all committee members have completed their shortlist.',
                ]);
            }

            // Step 1C: Check if the Chairperson's shortlist exists
            $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::select([
                'id',
                'nhidcl_resource_requisition_id',
                'created_by',
                'efile'
            ])->with(['creator:id,name,email'])
                ->where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_shortlist_by_id', 3], // Chairperson Shortlist
                    ['ref_shortlist_status_id', 2], // Only check "Generated"
                    ['is_deleted', false]
                ])->first();

            if (!$existingShortlist) {
                return response()->json([
                    'draw' => intval($request->draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'customMessage' => 'Chairperson has not completed their shortlist.',
                ]);
            }

            // Step 2: Get shortlisted candidates selected by the chairperson
            $candidatesQuery = User::join('nhidcl_requisition_applicant_shortlist_chair_person as shortlist', 'ref_users.id', '=', 'shortlist.ref_users_id')
                ->where('shortlist.nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id)
                ->where('shortlist.ref_interview_status_id', 8) // Only candidates selected by the chairperson
                ->where('shortlist.is_deleted', false)
                ->select('ref_users.id', 'ref_users.name', 'ref_users.email', 'ref_users.status');

            return DataTables::of($candidatesQuery)
                ->addIndexColumn()

                // Step 3: Fetch all committee members' remarks and status for each candidate
                ->addColumn('committee_remarks', function ($row) use ($request) {
                    return NhidclRequisitionApplicantShortlistCommittee::where('ref_users_id', $row->id)
                        ->join('nhidcl_resource_requisition_shortlist_applicant_details as shortlist_details', 'nhidcl_requisition_applicant_shortlist_committee.nhidcl_resource_requisition_shortlist_applicant_details_id', '=', 'shortlist_details.id')
                        ->where('shortlist_details.nhidcl_resource_requisition_id', $request->requisitionId)
                        ->join('ref_users as committee_member', 'committee_member.id', '=', 'nhidcl_requisition_applicant_shortlist_committee.created_by')
                        ->select(
                            'committee_member.name as committee_name',
                            'committee_member.email as committee_email',
                            'nhidcl_requisition_applicant_shortlist_committee.ref_interview_status_id',
                            'nhidcl_requisition_applicant_shortlist_committee.remark'
                        )
                        ->get()
                        ->map(function ($remark) {
                            return [
                                'name' => $remark->committee_name,
                                'email' => $remark->committee_email,
                                'status' => $remark->ref_interview_status_id == 6 ? "Selected" : "Rejected",
                                'remark' => $remark->remark ?? 'No remarks'
                            ];
                        })->values();
                })

                // Step 4: Fetch chairperson’s remark and status
                ->addColumn('chairperson_remarks', function ($row) use ($existingShortlist) {
                    return NhidclRequisitionApplicantShortlistChairPerson::where([
                        ['ref_users_id', $row->id],
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id]
                    ])
                        ->join('ref_users as chairperson', 'chairperson.id', '=', 'nhidcl_requisition_applicant_shortlist_chair_person.created_by')
                        ->select(
                            'chairperson.name as chairperson_name',
                            'chairperson.email as chairperson_email',
                            'nhidcl_requisition_applicant_shortlist_chair_person.ref_interview_status_id',
                            'nhidcl_requisition_applicant_shortlist_chair_person.remark'
                        )
                        ->get()
                        ->map(function ($remark) {
                            return [
                                'name' => $remark->chairperson_name ?? 'N/A',
                                'email' => $remark->chairperson_email ?? 'N/A',
                                'status' => isset($remark->ref_interview_status_id)
                                    ? ($remark->ref_interview_status_id == 8 ? "Selected" : "Rejected")
                                    : 'Unknown',
                                'remark' => $remark->remark ?? 'No remarks'
                            ];
                        })->values();
                })

                ->addColumn('view-profile', function ($row) {
                    // $showUrl = route('user-config.show', Crypt::encrypt($row->id));
                    $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row->id));
                    return '<a class="view-profile" target="_blank" href="' . $showUrl . '">
                            <i class="fa fa-eye text-blue-500" title="View Profile"></i>
                        </a>';
                })

                ->addColumn('select', function ($row) use ($request) {
                    $existingBatch = NhidclBatches::where('nhidcl_resource_requisition_id', $request->requisitionId)
                        ->whereHas('batchCandidates', function ($query) use ($row) {
                            $query->where('ref_users_id', $row->id);
                        })
                        ->select('id', 'is_exam', 'is_interview', 'exam_interview_timing')
                        ->first();
                    if ($existingBatch) {
                        $timingText = match (true) {
                            $existingBatch->is_exam && $existingBatch->is_interview => 'Exam & Interview at',
                            $existingBatch->is_exam => 'Exam at',
                            $existingBatch->is_interview => 'Interview at',
                            default => 'Date -',
                        };

                        $batchData = "Batch - {$existingBatch->id}, {$timingText} {$existingBatch->exam_interview_timing}";
                        $isBatchAssigned = true;
                    } else {
                        $batchData = "NA";
                        $isBatchAssigned = false;
                    }

                    return [
                        'batchData' => $batchData,
                        'isBatchAssigned' => $isBatchAssigned,
                    ];
                })
                ->rawColumns(['committee_remarks', 'chairperson_remarks', 'view-profile'])
                ->make(true);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'customMessage' => 'Oops, something went wrong. Please try again later.',
            ]);
        }
    }

    public function candidateBatch(Request $request)
    {
        try {

            // Get selectedCandidates as JSON and decode it
            $selectedCandidates = json_decode($request->input('selectedCandidates'), true);

            // Get form fields
            $requision_id_raw = $request->input('requision_id'); // e.g. "123-abc"
            $exam = $request->input('exam'); // true/false or 1/0
            $interview = $request->input('interview'); // true/false or 1/0
            $date_time = $request->input('date_time');

            // Validation
            $requision = explode("-", $requision_id_raw);
            if (empty($selectedCandidates) || empty($requision[0])) {
                return response()->json([
                    'data' => "",
                    'message' => "Provide correct data."
                ], 400);
            }

            DB::beginTransaction();
            $batchData = NhidclBatches::create([
                "is_exam" => $exam ? true : false,
                "is_interview" => $interview ? true : false,
                "exam_interview_timing" => $date_time ?? null,
                "nhidcl_resource_requisition_id" => $requision[0],
            ]);

            foreach ($selectedCandidates as $candidate) {
                if (!empty($candidate['id'])) {
                    NhidclBatchCandidates::create([
                        "ref_users_id" => $candidate['id'],
                        "nhidcl_batches_id" => $batchData->id,
                    ]);

                    // Fetch user details
                    $user = User::select('email', 'name')->where('id', $candidate['id'])->first();

                    if ($user && $user->email) {
                        $timingText = match (true) {
                            $batchData->is_exam && $batchData->is_interview => 'Exam & Interview at',
                            $batchData->is_exam => 'Exam at',
                            $batchData->is_interview => 'Interview at',
                            default => 'Date -',
                        };

                        $text = match (true) {
                            $batchData->is_exam && $batchData->is_interview => 'Exam & Interview have been scheduled at',
                            $batchData->is_exam => 'Exam has been scheduled at',
                            $batchData->is_interview => 'Interview has been scheduled at',
                            default => 'Date -',
                        };

                        $subjectText = "{$timingText} {$batchData->exam_interview_timing} in batch number {$batchData->id} - Resource Pool | NHIDCL";

                        $htmlContent = "
                            <body style='font-family: Arial, sans-serif; background: #ffffff; color: #333;'>
                                <div style='max-width: 600px; margin: auto; padding: 20px; background: #ffffff;'>
                                    Dear {$user->name},<br/><br/>
                                    Your {$text} {$batchData->exam_interview_timing} in batch number {$batchData->id}.<br/><br/>
                                    <hr style='border: none; border-top: 1px solid #ccc;'><br/>
                                    <p style='font-size: 12px; color: #777; text-align: center;'>
                                        Sent by – <strong>National Highways & Infrastructure Development Corporation Ltd.<br>
                                        1st & 2nd Floor, Tower A, World Trade Centre, Nauroji Nagar, New Delhi – 110029</strong>
                                    </p>
                                </div>
                            </body>
                        ";

                        // Use Mail::send instead of Mail::raw for HTML
                        Mail::html($htmlContent, function ($message) use ($user, $subjectText) {
                            $message->to($user->email)
                                    ->subject($subjectText);
                        });
                    }
                }
            }

            DB::commit();
            return response()->json(['message' => "Batch generated successfully"], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }
}
