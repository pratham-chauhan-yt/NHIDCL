<?php

namespace App\Http\Controllers\ResourcePool\CommitteeMember;

use App\Http\Controllers\Controller;
use App\Models\NhidclResourceAdvertisementCommitte;
use App\Models\NhidclResourceRequisition;
use App\Models\NhidclUserStatus;
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
        $this->middleware('permission:resource pool - create committee shortlist|resource pool - view committee shortlist')->only(['selectionProcess']);
    }

    public function dashboard(Request $request)
    {
        $header = true;
        $sidebar = true;
        return view('resource-pool.committee-member.dashboard', compact('sidebar', 'header'));
    }

    public function selectionProcess(Request $request)
    {
        $userId = auth()->id();

        if ($request->ajax()) {
            $request->validate([
                'requisitionId' => 'required|integer'
            ]);

            // Check if the logged-in user is assigned to the requisition as a committee member
            $isAssigned = NhidclResourceAdvertisementCommitte::where([
                ['nhidcl_resource_requisition_id', $request->requisitionId],
                ['ref_committe_id', $userId],
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
                // ->whereIn('ref_shortlist_status_id', [2, 3]) // Status: Generated (2) or Cancelled (3)
                ->orderBy('id', 'asc') // Sort by ID ascending
                ->select('id', 'ref_shortlist_status_id', 'remarks')
                ->get();

            return response()->json([
                'success' => true,
                'shortlists' => $shortlists
            ]);
        }

        $requisitionYears = NhidclResourceAdvertisementCommitte::join('nhidcl_resource_requisition', 'nhidcl_resource_advertisement_committe.nhidcl_resource_requisition_id', '=', 'nhidcl_resource_requisition.id')
            ->where('nhidcl_resource_advertisement_committe.ref_committe_id', $userId)
            ->where('nhidcl_resource_advertisement_committe.is_deleted', false)
            ->where('nhidcl_resource_requisition.is_deleted', false) // If 'is_deleted' exists in requisition table
            ->selectRaw('EXTRACT(YEAR FROM nhidcl_resource_requisition.created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $listOfRequisitions = [];

        if ($requisitionYears->isNotEmpty()) {
            $listOfRequisitions = NhidclResourceRequisition::where('is_deleted', false)
                ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$requisitionYears->first()])
                ->whereIn('id', function ($query) use ($userId) {
                    $query->select('nhidcl_resource_requisition_id')
                        ->from('nhidcl_resource_advertisement_committe')
                        ->where('ref_committe_id', $userId)
                        ->where('is_deleted', false); // Ensure deleted records are excluded
                })
                ->select('id', 'job_title')
                ->orderBy('id', 'asc')
                ->get();
        }

        $header = true;
        $sidebar = true;
        return view('resource-pool.committee-member.selection-process', compact('sidebar', 'header', 'requisitionYears', 'listOfRequisitions'));
    }

    public function getListOfCandidate(Request $request)
    {
        if ($request->ajax() && $request->requisitionId && $request->shortlistId) {
            try {
                $userId = auth()->id();

                // Step 1: Validate if the shortlist belongs to the given requisition and is GENERATED (2)
                $shortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
                    ['id', $request->shortlistId],
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_shortlist_status_id', 2], // Only Generated status
                    ['is_deleted', false]
                ])->first();

                if (!$shortlist) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid shortlist selection or status is not "Generated".'
                    ], 403);
                }

                // Step 2: Ensure the requisition is assigned to the logged-in committee member
                $isAssigned = NhidclResourceAdvertisementCommitte::where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_committe_id', $userId], // Logged-in user must be assigned
                    ['is_deleted', false]
                ])->exists();

                if (!$isAssigned) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized: You are not assigned to this requisition.'
                    ], 403);
                }

                // Step 3: Check if a draft shortlist exists for the requisition created by the logged-in user
                $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
                    ['nhidcl_resource_requisition_id', $request->requisitionId],
                    ['ref_shortlist_by_id', 2], // Committee Shortlist
                    ['created_by', $userId], // Created by logged-in user
                    ['is_deleted', false]
                ])->first();

                // Step 4: Fetch user IDs based on shortlist existence
                $userIds = [];
                $userData = [];
                if ($existingShortlist) {
                    $userData = NhidclRequisitionApplicantShortlistCommittee::where([
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id],
                        ['is_deleted', false]
                    ])
                        ->select('ref_users_id', 'ref_interview_status_id', 'remark') // Fetch selection status and remark
                        ->get()
                        ->keyBy('ref_users_id'); // Store as an associative array for quick lookup

                    $userIds = $userData->keys()->toArray();
                } else {
                    $userIds = NhidclRequisitionApplicantShortlistHr::where([
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $request->shortlistId],
                        ['is_deleted', false]
                    ])
                        ->pluck('ref_users_id')
                        ->toArray();
                }

                if (empty($userIds)) {
                    return response()->json([
                        'data' => [],
                        'recordsFiltered' => 0,
                        'recordsTotal' => 0
                    ]);
                }

                // Step 5: Fetch users from ref_users table
                $users = User::where('is_deleted', false)
                    ->whereIn('id', $userIds)
                    ->select('id', 'name', 'email', 'status')
                    ->get();

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('select', function ($row) use ($existingShortlist, $userData) {
                        return [
                            'checked' => isset($userData[$row->id]) && isset($userData[$row->id]->ref_interview_status_id) && $userData[$row->id]->ref_interview_status_id == 6,
                            'disabled' => ($existingShortlist && isset($existingShortlist->ref_shortlist_status_id)) ? $existingShortlist->ref_shortlist_status_id == 2 : false,
                        ];
                    })
                    ->addColumn('remark', function ($row) use ($existingShortlist, $userData) {
                        return [
                            'remark' => htmlspecialchars(isset($userData[$row->id]) && isset($userData[$row->id]->remark) ? $userData[$row->id]->remark : '', ENT_QUOTES, 'UTF-8'),
                            'disabled' => ($existingShortlist && isset($existingShortlist->ref_shortlist_status_id)) ? $existingShortlist->ref_shortlist_status_id == 2 : false,
                        ];
                    })
                    ->addColumn('view-profile', function ($row) {
                        // $showUrl = route('user-config.show', Crypt::encrypt($row->id));
                        $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row->id));
                        return '<a class="view-profile" target="_blank" href="' . $showUrl . '">
                            <i class="fa fa-eye text-blue-500" title="View Profile"></i>
                        </a>';
                    })
                    ->rawColumns(['select', 'remark', 'view-profile'])
                    ->make(true);
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => [],
                    'recordsFiltered' => 0,
                    'recordsTotal' => 0,
                    // 'error' => $th->getMessage() // Debugging purposes
                ], 500);
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
                ['ref_shortlist_by_id', 2], // Committee Shortlist
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
                    NhidclRequisitionApplicantShortlistCommittee::where([
                        ['nhidcl_resource_requisition_shortlist_applicant_details_id', $existingShortlist->id],
                        ['ref_users_id', $candidateId]
                    ])
                        ->update([
                            'remark' => $data['remark'],
                            'ref_interview_status_id' => $data['selected'] ? 6 : 7, // Assign status if selected
                            'updated_by' => $userId,
                            'updated_at' => now()
                        ]);
                }
            } else {
                // Step 3B: If no draft exists, create a new shortlist in draft status
                $newShortlist = NhidclResourceRequisitionShortlistApplicantDetail::create([
                    'nhidcl_resource_requisition_id' => $request->requisitionId,
                    'ref_shortlist_by_id' => 2, // Committee Shortlist
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

                // Step 5: Store all users in nhidcl_requisition_applicant_shortlist_committee
                foreach ($allUserIds as $candidateId) {
                    $selected = isset($candidates[$candidateId]) ? ($candidates[$candidateId]['selected'] ? 6 : 7) : 7;
                    // $selected = $candidates[$candidateId]['selected'] ? $candidates[$candidateId]['selected'] : false;
                    $remark = $candidates[$candidateId]['remark'] ?? null;

                    NhidclRequisitionApplicantShortlistCommittee::create([
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
                ['ref_shortlist_by_id', 2], // Committee Shortlist
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
                    'ref_shortlist_by_id' => 2, // Committee Shortlist
                    'ref_shortlist_status_id' => 1, // Draft status
                    'created_by' => $userId,
                    'is_deleted' => false
                ]);

                $shortlistId = $newShortlist->id;
                $finalShortlist = $newShortlist;
            }

            // Step 3: Convert received candidates into a properly formatted array
            $candidates = collect($request->input('candidates', []))->mapWithKeys(function ($candidate) {
                return [
                    $candidate['id'] => [
                        'selected' => filter_var($candidate['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
                        'remark' => $candidate['remark'] ?? null
                    ]
                ];
            })->toArray();
            $selected = null;
            if ($existingShortlist) {
                // Step 4A: If a draft exists, update only the incoming candidates
                foreach ($candidates as $candidateId => $data) {
                    $selectionStatus = $data['selected'] ? 6 : 7;
                    NhidclRequisitionApplicantShortlistCommittee::where([
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

                // Step 5: Store all users in nhidcl_requisition_applicant_shortlist_committee
                foreach ($allUserIds as $candidateId) {
                    $selected = isset($candidates[$candidateId]) ? ($candidates[$candidateId]['selected'] ? 6 : 7) : 7;
                    // $selected = $candidates[$candidateId]['selected'] ? 6 : 7;
                    $remark = $candidates[$candidateId]['remark'] ?? null;


                    NhidclRequisitionApplicantShortlistCommittee::create([
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
            return response()->json(['message' => 'Shortlist has been generated successfully!', 'selected' => $selected], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    // Empty candidate list validation
    // public function generateShortlist(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $userId = auth()->id();
    //         $shortlistId = null; // Declare to ensure accessibility

    //         // Step 1: Check if a draft shortlist exists for the requisition created by the logged-in user
    //         $existingShortlist = NhidclResourceRequisitionShortlistApplicantDetail::where([
    //             ['nhidcl_resource_requisition_id', $request->requisitionId],
    //             ['ref_shortlist_by_id', 2], // Committee Shortlist
    //             ['created_by', $userId], // Created by logged-in user
    //             ['is_deleted', false]
    //         ])->first();

    //         if ($existingShortlist) {
    //             if ($existingShortlist->ref_shortlist_status_id !== 1) {
    //                 DB::rollBack();
    //                 return response()->json(['message' => 'A shortlist already exists or is cancelled'], 500);
    //             }
    //             $shortlistId = $existingShortlist->id;
    //         } else {
    //             // Step 2: Convert received candidates into a properly formatted array
    //             $candidates = collect($request->input('candidates', []))->mapWithKeys(function ($candidate) {
    //                 return [
    //                     $candidate['id'] => [
    //                         'selected' => filter_var($candidate['selected'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
    //                         'remark' => $candidate['remark'] ?? null
    //                     ]
    //                 ];
    //             })->toArray();

    //             // **Step 3: Ensure at least one candidate is selected**
    //             if (empty($candidates)) {
    //                 DB::rollBack();
    //                 return response()->json(['message' => 'Please select at least one candidate.'], 422);
    //             }

    //             // Step 4: Create a new shortlist in draft status
    //             $newShortlist = NhidclResourceRequisitionShortlistApplicantDetail::create([
    //                 'nhidcl_resource_requisition_id' => $request->requisitionId,
    //                 'ref_shortlist_by_id' => 2, // Committee Shortlist
    //                 'ref_shortlist_status_id' => 1, // Draft status
    //                 'created_by' => $userId,
    //                 'is_deleted' => false
    //             ]);

    //             $shortlistId = $newShortlist->id;
    //         }

    //         // Step 5: Process the candidates for the shortlist
    //         if ($existingShortlist) {
    //             foreach ($candidates as $candidateId => $data) {
    //                 NhidclRequisitionApplicantShortlistCommittee::where([
    //                     ['nhidcl_resource_requisition_shortlist_applicant_details_id', $shortlistId],
    //                     ['ref_users_id', $candidateId]
    //                 ])->update([
    //                             'remark' => $data['remark'],
    //                             'ref_interview_status_id' => $data['selected'] ? 6 : 7, // Assign status if selected
    //                             'updated_by' => $userId,
    //                             'updated_at' => now()
    //                         ]);
    //             }
    //         } else {
    //             // Fetch all existing user IDs for this shortlist
    //             $allUserIds = where([
    //     ['nhidcl_resource_requisition_shortlist_applicant_details_id', $request->shortlistId],
    //     ['is_deleted', false]
    // ])->pluck('ref_users_id')
    //                 ->toArray();

    //             foreach ($allUserIds as $candidateId) {
    //                 $selected = $candidates[$candidateId]['selected'] ?? false;
    //                 $remark = $candidates[$candidateId]['remark'] ?? null;

    //                 NhidclRequisitionApplicantShortlistCommittee::create([
    //                     'nhidcl_resource_requisition_shortlist_applicant_details_id' => $shortlistId,
    //                     'ref_users_id' => $candidateId,
    //                     'created_by' => $userId,
    //                     'is_deleted' => false,
    //                     'remark' => $remark,
    //                     'ref_interview_status_id' => $selected ? 6 : 7,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ]);
    //             }
    //         }

    //         // Step 6: Update shortlist status to GENERATED (2)
    //         NhidclResourceRequisitionShortlistApplicantDetail::where('id', $shortlistId)->update([
    //             'ref_shortlist_status_id' => 2, // Generated status
    //             'updated_by' => $userId,
    //             'updated_at' => now()
    //         ]);

    //         DB::commit();
    //         return response()->json(['message' => 'Shortlist has been generated successfully!'], 200);

    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return response()->json(['message' => $th->getMessage()], 500);
    //     }
    // }

}
