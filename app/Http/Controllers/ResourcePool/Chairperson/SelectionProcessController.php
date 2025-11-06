<?php

namespace App\Http\Controllers\ResourcePool\Chairperson;

use App\Http\Controllers\Controller;
use App\Models\NhidclResourceAdvertisementCommitte;
use App\Models\NhidclResourceRequisition;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistChairPerson;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistCommittee;
use App\Models\ResourcePool\NhidclRequisitionApplicantShortlistHr;
use App\Models\ResourcePool\NhidclResourceRequisitionShortlistApplicantDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SelectionProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:resource pool - create chairperson shortlist|resource pool - view chairperson shortlist')->only(['selectionProcess']);
    }

    public function selectionProcess(Request $request)
    {
        $userId = auth()->id();

        if ($request->ajax()) {
            $request->validate([
                'requisitionId' => 'required|integer'
            ]);

            // Check if the logged-in user is assigned to the requisition as a chairperson member
            $isAssigned = NhidclResourceRequisition::where([
                ['id', $request->requisitionId],
                ['ref_chairperson_id', $userId],
                ['is_deleted', false] // Ensure requisition assignment is active
            ])->exists();

            if (!$isAssigned) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: You are not assigned to this requisition.'
                ], 403);
            }

            // Fetch shortlists only if the user is assigned
            $shortlists = NhidclResourceRequisitionShortlistApplicantDetail::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['ref_shortlist_status_id', 2],
                ['ref_shortlist_by_id', 1], // HR Shortlist
                ['is_deleted', false] // Ensure only active records
            ])
                ->orderBy('id', 'asc') // Sort by ID ascending
                ->select('id', 'ref_shortlist_status_id', 'remarks')
                ->get();

            // $detailOfMembers = NhidclResourceAdvertisementCommitte::where([
            //     ['nhidcl_resource_requisition_id', $request->requisitionId],
            //     ['is_deleted', false] // Ensure requisition assignment is active
            // ])->get();

            // dd($detailOfMembers);

            return response()->json([
                'success' => true,
                'shortlists' => $shortlists
            ]);
        }

        $requisitionYears = NhidclResourceRequisition::where([
            ['ref_chairperson_id', $userId],
            ['is_deleted', false]
        ])
            ->selectRaw('EXTRACT(YEAR FROM created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $listOfRequisitions = [];

        if ($requisitionYears->isNotEmpty()) {
            $listOfRequisitions = NhidclResourceRequisition::where([
                ['ref_chairperson_id', $userId],
                ['is_deleted', false]
            ])
                ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
                ->select('id', 'job_title')
                ->orderBy('id', 'asc')
                ->get();
        }

        $header = true;
        $sidebar = true;
        return view('resource-pool.chairperson.selection-process', compact('sidebar', 'header', 'listOfRequisitions', 'requisitionYears'));
    }

    public function getListOfCandidate(Request $request)
    {
        if ($request->ajax() && $request->requisitionId && $request->shortlistId) {
            try {
                $userId = auth()->id();

                // Step 1A: Fetch list of committee members
                $committeeMembers = NhidclResourceAdvertisementCommitte::where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['is_deleted', false]
                ])->pluck('ref_committe_id')->toArray();

                if (empty($committeeMembers)) {
                    return response()->json([
                        "draw" => intval($request->draw),
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => [],
                        "customMessage" => "No committee members assigned to this requisition."
                    ]);
                }

                // Step 1B: Check if all committee members have generated their shortlist
                $shortlistGenerated = NhidclResourceRequisitionShortlistApplicantDetail::where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_shortlist_by_id', 2], // Committee Shortlist
                    ['ref_shortlist_status_id', 2], // Only check for "Generated"
                    ['is_deleted', false]
                ])->whereIn('created_by', $committeeMembers)
                    ->count();

                if ($shortlistGenerated < count($committeeMembers)) {
                    return response()->json([
                        "draw" => intval($request->draw),
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => [],
                        "customMessage" => "Not all committee members have completed their shortlist."
                    ]);
                }

                // Step 1C: Check if the chairperson's shortlist exists
                $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_shortlist_by_id', 3], // Chairperson Shortlist
                    ['created_by', $userId], // Created by logged-in user
                    ['is_deleted', false]
                ])->first();

                // Step 2: Get all shortlisted candidates through correct joins
                $candidates = User::join('nhidcl_requisition_applicant_shortlist_committee as shortlist', 'ref_users.id', '=', 'shortlist.ref_users_id')
                    ->join('nhidcl_resource_requisition_shortlist_applicant_details as shortlist_details', 'shortlist.nhidcl_resource_requisition_shortlist_applicant_details_id', '=', 'shortlist_details.id')
                    ->where('shortlist.is_deleted', false)
                    ->where('shortlist_details.nhidcl_resource_requisition_id', $request->requisitionId)
                    ->select('ref_users.id', 'ref_users.name', 'ref_users.email', 'ref_users.status')
                    ->distinct()
                    ->get()
                    ->map(function ($candidate) use ($request, $existingShortlist) {
                        // Step 3: Fetch all committee members' remarks and status for each candidate
                        $committeeRemarks = NhidclRequisitionApplicantShortlistCommittee::where('ref_users_id', $candidate->id)
                            ->join('nhidcl_resource_requisition_shortlist_applicant_details as shortlist_details', 'nhidcl_requisition_applicant_shortlist_committee.nhidcl_resource_requisition_shortlist_applicant_details_id', '=', 'shortlist_details.id')
                            ->where('shortlist_details.nhidcl_resource_requisition_id', $request->requisitionId)
                            ->join('ref_users as committee_member', 'committee_member.id', '=', 'nhidcl_requisition_applicant_shortlist_committee.created_by')
                            ->select(
                                'committee_member.id as committee_id',
                                'committee_member.name as committee_name',
                                'committee_member.email as committee_email',
                                'nhidcl_requisition_applicant_shortlist_committee.ref_interview_status_id',
                                'nhidcl_requisition_applicant_shortlist_committee.remark'
                            )
                            ->get();

                        // Step 4: Fetch chairperson’s remark and status (if shortlist exists)
                        $chairpersonRemark = null;
                        if ($existingShortlist) {
                            $chairpersonRemark = NhidclRequisitionApplicantShortlistChairPerson::where([
                                ['ref_users_id', $candidate->id],
                                ['nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id]
                            ])
                                ->join('ref_users as chairperson', 'chairperson.id', '=', 'nhidcl_requisition_applicant_shortlist_chair_person.created_by')
                                ->select(
                                    'chairperson.id as chairperson_id',
                                    'chairperson.name as chairperson_name',
                                    'chairperson.email as chairperson_email',
                                    'nhidcl_requisition_applicant_shortlist_chair_person.ref_interview_status_id',
                                    'nhidcl_requisition_applicant_shortlist_chair_person.remark'
                                )
                                ->first();
                        }

                        return [
                            'id' => $candidate->id,
                            'name' => $candidate->name,
                            'email' => $candidate->email,
                            'status' => $candidate->status,
                            'committee_remarks' => $committeeRemarks,
                            'chairperson_remarks' => $chairpersonRemark
                        ];
                    });

                return DataTables::of($candidates)
                    ->addIndexColumn()
                    ->addColumn('committee_remarks', function ($row) {
                        return collect($row['committee_remarks'])->map(function ($remark) {
                            return [
                                'name' => $remark['committee_name'], // Corrected field names
                                'email' => $remark['committee_email'],
                                'status' => $remark['ref_interview_status_id'] == 6 ? "Selected" : "Rejected", // Ensuring correct interview status
                                'remark' => $remark['remark'] ?? 'No remarks', // Handling null remarks
                            ];
                        })->values()->all(); // Convert to indexed array for JavaScript compatibility
                    })
                    ->addColumn('select', function ($row) use ($existingShortlist) {
                        return [
                            'checked' => isset($row['chairperson_remarks']) && isset($row['chairperson_remarks']['ref_interview_status_id']) && $row['chairperson_remarks']['ref_interview_status_id'] == 8,
                            'disabled' => ($existingShortlist && isset($existingShortlist->ref_shortlist_status_id)) ? $existingShortlist->ref_shortlist_status_id == 2 : false,
                        ];
                    })
                    ->addColumn('remark', function ($row) use ($existingShortlist) {
                        return [
                            'remark' => htmlspecialchars(isset($row['chairperson_remarks']) && isset($row['chairperson_remarks']['remark']) ? $row['chairperson_remarks']['remark'] : '', ENT_QUOTES, 'UTF-8'),
                            'disabled' => ($existingShortlist && isset($existingShortlist->ref_shortlist_status_id)) ? $existingShortlist->ref_shortlist_status_id == 2 : false,
                        ];
                    })
                    ->addColumn('view-profile', function ($row) {
                        // $showUrl = route('user-config.show', Crypt::encrypt($row['id']));
                        $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row['id']));
                        return '<a class="view-profile" target="_blank" href="' . $showUrl . '">
                    <i class="fa fa-eye text-blue-500" title="View Profile"></i>
                </a>';
                    })
                    ->rawColumns(['committee_remarks', 'remark', 'select', 'view-profile'])
                    ->make(true);

            } catch (\Throwable $th) {
                return response()->json([
                    "draw" => intval($request->draw),
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => [],
                    "customMessage" => "Oops, something went wrong. Please try again later."
                ]);
            }
        }

        return response()->json([
            'data' => [],
            'recordsFiltered' => 0,
            'recordsTotal' => 0
        ]);
    }

    public function saveShortlistDraft(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = auth()->id();

            // Step 1: Check if a draft shortlist exists for the requisition created by the logged-in user
            $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['ref_shortlist_by_id', 3], // Chairperson Shortlist
                ['ref_shortlist_status_id', 1], // Draft status
                ['created_by', $userId], // Created by logged-in user
                ['is_deleted', false]
            ])->first();

            // Step 2: Convert received candidates into a properly formatted array
            $candidates = collect($request->input('candidates', []))->mapWithKeys(function ($candidate) {
                return [
                    $candidate['id'] => [
                        'selected' => filter_var($candidate['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                        'remark' => $candidate['remark'] ?? null
                    ]
                ];
            })->toArray();

            if ($existingShortlist) {
                // Step 3A: If a draft exists, update only the incoming candidates
                foreach ($candidates as $candidateId => $data) {
                    NhidclRequisitionApplicantShortlistChairPerson::where([
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id],
                        ['ref_users_id', $candidateId]
                    ])
                        ->update([
                            'remark' => $data['remark'],
                            'ref_interview_status_id' => $data['selected'] ? 8 : 9, // Assign status if selected
                            'updated_by' => $userId,
                            'updated_at' => now()
                        ]);
                }
            } else {
                // Step 3B: If no draft exists, create a new shortlist in draft status
                $newShortlist = NhidclResourceRequisitionShortlistApplicantDetail::create([
                    'nhidcl_resource_requisition_id' => $request->requisitionId,
                    'ref_shortlist_by_id' => 3, // Chairperson Shortlist
                    'ref_shortlist_status_id' => 1, // Draft status
                    'created_by' => $userId,
                    'is_deleted' => false
                ]);

                $shortlistId = $newShortlist->id;

                // Step 4: Fetch all existing user IDs for this shortlist
                $allUserIds = NhidclRequisitionApplicantShortlistHr::where([
                    ['nhidcl_resource_requisition_shortlist_applicant_details_id', $request->shortlistId],
                    ['is_deleted', false]
                ])->pluck('ref_users_id')
                    ->toArray();

                // Step 5: Store all users in nhidcl_requisition_applicant_shortlist_chairperson
                foreach ($allUserIds as $candidateId) {
                    $selected = isset($candidates[$candidateId]) ? ($candidates[$candidateId]['selected'] ? 8 : 9) : 9;
                    // $selected = $candidates[$candidateId]['selected'] ? $candidates[$candidateId]['selected'] : false;
                    $remark = $candidates[$candidateId]['remark'] ?? null;

                    NhidclRequisitionApplicantShortlistChairPerson::create([
                        'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortlistId,
                        'ref_users_id' => $candidateId,
                        'created_by' => $userId,
                        'is_deleted' => false,
                        'remark' => $remark,
                        'ref_interview_status_id' => $selected,
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Draft saved successfully!'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function generateShortlist(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = auth()->id();
            $shortlistId = null;
            $finalShortlist = null;

            // Step 1: Check if a draft shortlist exists for the requisition created by the logged-in user
            $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['ref_shortlist_by_id', 3], // Chairperson Shortlist
                ['created_by', $userId], // Created by logged-in user
                ['is_deleted', false]
            ])->first();

            if ($existingShortlist) {
                if ($existingShortlist->ref_shortlist_status_id !== 1) {
                    DB::rollBack();
                    return response()->json(['message' => 'A shortlist already exists or is cancelled'], 500);
                }
                $shortlistId = $existingShortlist->id;
                $finalShortlist = $existingShortlist;
            } else {
                // Step 2: Create a new shortlist if none exists
                $newShortlist = NhidclResourceRequisitionShortlistApplicantDetail::create([
                    'nhidcl_resource_requisition_id' => $request->requisitionId,
                    'ref_shortlist_by_id' => 3, // Chairperson Shortlist
                    'ref_shortlist_status_id' => 1, // Draft status
                    'created_by' => $userId,
                    'is_deleted' => false
                ]);

                $shortlistId = $newShortlist->id;
                $finalShortlist = $newShortlist;
            }

            $candidates = collect($request->input('candidates', []))->mapWithKeys(function ($candidate) {
                return [
                    $candidate['id'] => [
                        'selected' => filter_var($candidate['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                        'remark' => $candidate['remark'] ?? null
                    ]
                ];
            })->toArray();
            // Step 3: Convert received candidates into a properly formatted array
            $candidates = collect($request->input('candidates', []))->mapWithKeys(function ($candidate) {
                return [
                    $candidate['id'] => [
                        'selected' => filter_var($candidate['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                        'remark' => $candidate['remark'] ?? null
                    ]
                ];
            })->toArray();

            if ($existingShortlist) {
                // Step 4A: If a draft exists, update only the incoming candidates
                foreach ($candidates as $candidateId => $data) {
                    $selectionStatus = $data['selected'] ? 8 : 9;
                    NhidclRequisitionApplicantShortlistChairPerson::where([
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $shortlistId],
                        ['ref_users_id', $candidateId]
                    ])->update([
                                'remark' => $data['remark'],
                                'ref_interview_status_id' => $selectionStatus,
                                'updated_by' => $userId,
                                'updated_at' => now()
                            ]);
                }
            } else {
                // Step 4B: Fetch all existing user IDs for this shortlist
                $allUserIds = NhidclRequisitionApplicantShortlistHr::where([
                    ['nhidcl_resource_requisition_shortlist_applicant_details_id', $request->shortlistId],
                    ['is_deleted', false]
                ])->pluck('ref_users_id')
                    ->toArray();

                // Step 5: Store all users in nhidcl_requisition_applicant_shortlist_chairperson
                foreach ($allUserIds as $candidateId) {
                    $selected = isset($candidates[$candidateId]) ? ($candidates[$candidateId]['selected'] ? 8 : 9) : 9;
                    // $selected = $candidates[$candidateId]['selected'] ? 8 : 9;
                    $remark = $candidates[$candidateId]['remark'] ?? null;

                    NhidclRequisitionApplicantShortlistChairPerson::create([
                        'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortlistId,
                        'ref_users_id' => $candidateId,
                        'created_by' => $userId,
                        'is_deleted' => false,
                        'remark' => $remark,
                        'ref_interview_status_id' => $selected,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            // Step 6: Update shortlist status to GENERATED (2)
            $finalShortlist->update([
                'ref_shortlist_status_id' => 2, // Generated status
                'updated_by' => $userId,
                'updated_at' => now()
            ]);

            DB::commit();
            return response()->json(['message' => 'Shortlist has been generated successfully!'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
