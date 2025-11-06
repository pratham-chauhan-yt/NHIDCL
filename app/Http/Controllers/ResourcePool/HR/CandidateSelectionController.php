<?php

namespace App\Http\Controllers\ResourcePool\HR;

use App\Http\Controllers\Controller;
use App\Mail\OfferLetterMail;
use App\Models\NhidclBatches;
use Illuminate\Http\Request;
use App\Models\NhidclBatchCandidates;
use App\Models\NhidclResourceRequisition;
use App\Models\ResourcePool\NhidclResourceRequisitionFinalShortlistApplicant;
use App\Models\User;
use DataTables;
use Crypt;
use Illuminate\Support\Facades\Mail;
use Log;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateSelectionController extends Controller
{
    public function getListOfBatches(Request $request)
    {
        if ($request->ajax() && $request->requisitionId) {
            $batches = NhidclBatches::where('nhidcl_resource_requisition_id', $request->requisitionId)
            ->where('is_deleted', false)
            ->get();
            return response()->json([
                'success' => true,
                'batches' => $batches
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Oops, something went wrong. Please try again later."
        ], 400);

    }
    public function batchListedUser(Request $request)
    {
        try {
            if ($request->ajax() && $request->batch_id) {
                $candidates = NhidclBatchCandidates::with('user')->where("nhidcl_batches_id", $request->batch_id)->get();
                $previousShortlisted = NhidclResourceRequisitionFinalShortlistApplicant::where('nhidcl_batches_id', $request->batch_id)->get()->keyBy('ref_users_id');
                //dd($candidates);
                if ($candidates) {
                    try {
                        return DataTables::of($candidates)
                            ->addIndexColumn()
                            ->addColumn('view-profile', function ($row) {
                                // $showUrl = route('user-config.show', Crypt::encrypt($row['id']));
                                $showUrl = route('resource-pool.userDetails', Crypt::encrypt($row['id']));
                                return '<a class="view-profile" target="_blank" href="' . $showUrl . '">
                                <i class="fa fa-eye text-blue-500" title="View Profile"></i>
                            </a>';
                            })
                            ->addColumn('user_id', function ($row) {
                                return $row->user->id;
                            })
                            ->addColumn('name', function ($row) {
                                return $row->user->name;
                            })
                            ->addColumn('email', function ($row) {
                                return $row->user->email;
                            })
                            ->addColumn('user_id', function ($row) {
                                return $row->user->id;
                            })
                            ->addColumn('status', function ($row) {
                                return $row->user->status;
                            })
                            ->addColumn('select', function ($row) use ($previousShortlisted) {
                                $prev = $previousShortlisted[$row->user->id] ?? null;
                                $selected = $prev->status ?? '';

                                $options = ['Rejected', 'Rejected By Applicant', 'Reserve', 'Selected'];
                                $selectHtml = '<select class="select-status" name="status" data-id="' . $row->user->id . '">';
                                $selectHtml .= '<option value="">Select Status</option>';
                                foreach ($options as $option) {
                                    $isSelected = ($option === $selected) ? 'selected' : '';
                                    $selectHtml .= '<option value="' . $option . '" ' . $isSelected . '>' . $option . '</option>';
                                }
                                $selectHtml .= '</select>';
                                return $selectHtml;
                            })
                            ->addColumn('offer_letter', function ($row) use ($previousShortlisted) {
                                $prev = $previousShortlisted[$row->user->id] ?? null;
                                $fileUrl = ($prev && $prev->offer_letter_file) ? 'viewFiles?pathName=uploads/hr/upload_offer_letter/&fileName='.$prev->offer_letter_file : '#';
                                $isFileAvailable = ($prev && $prev->offer_letter_file) ? '' : 'hidden';

                                $html = '';
                                $html .= '<input type="file" name="offer_letter_file" class="upload-offer" data-id="' . $row->user->id . '">';
                                $html .= '<a href="' . $fileUrl . '" target="_blank" class="view-offer-letter text-blue-500 underline ' . $isFileAvailable . '">View File</a>';
                                $html .= '<input type="hidden" class="store-filepath">';

                                return $html;
                            })
                            ->addColumn('date_of_joining', function ($row) use ($previousShortlisted) {
                                $prev = $previousShortlisted[$row->user->id] ?? null;
                                $date = $prev?->date_of_joining;
                                return '<input type="date" name="date_of_joining" class="date-of-joining" data-id="' . $row->user->id . '" value="' . $date . '">';
                            })
                            ->addColumn('remark', function ($row) use ($previousShortlisted) {
                                $prev = $previousShortlisted[$row->user->id] ?? null;
                                $remark = $prev?->remark ?? '';
                                return '<input type="text" name="remark" placeholder="Remark" class="remark" data-id="' . $row->user->id . '" value="' . ($remark) . '">';
                            })
                            ->addColumn('action', function ($row) use ($previousShortlisted) {
                                $prev = $previousShortlisted[$row->user->id] ?? null;
                                $title = $prev ? 'Update' : 'Submit';
                                $btnClass = ($title === 'Submit') ? 'primary' : 'warning';
                                return '<button class="submit-btn btn btn-' . $btnClass . ' btn-sm" data-id="' . $row->user->id . '">' . $title . '</button>';
                            })
                            ->rawColumns(['view-profile', 'action', 'select', 'offer_letter', 'date_of_joining', 'remark'])
                            ->make(true);

                    } catch (\Throwable $th) {
                        return response()->json([
                            //"draw" => intval($request->draw),
                            "recordsTotal" => 0,
                            "recordsFiltered" => 0,
                            "data" => [],
                            "customMessage" => "Oops, something went wrong. Please try again later."
                        ]);
                    }
                }
            }
            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                "customMessage" => "No data found"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                "customMessage" => "Oops, something went wrong. Please try again later."
            ]);
        }
    }

    public function finalShortlistCandidate(Request $request)
    {
        $validated = $request->validate([
            'nhidcl_resource_requisition_id' => 'required|integer|exists:nhidcl_resource_requisition,id',
            'nhidcl_batches_id' => 'required|integer|exists:nhidcl_batches,id',
            'ref_users_id' => 'required|integer|exists:ref_users,id',
            'status' => 'required|string',  // in:Selected,Rejected,Rejected By Applicant,Reserve',
            'offer_letter_file' => 'nullable|string',
            'date_of_joining' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        $candidateData = [
            'status' => $validated['status'],
            'offer_letter_file' => $validated['offer_letter_file'] ?? null,
            'date_of_joining' => $validated['date_of_joining'] ?? null,
            'remark' => $validated['remark'] ?? null,
        ];

        $existing = NhidclResourceRequisitionFinalShortlistApplicant::where([
            ['nhidcl_resource_requisition_id', $validated['nhidcl_resource_requisition_id']],
            ['nhidcl_batches_id', $validated['nhidcl_batches_id']],
            ['ref_users_id', $validated['ref_users_id']],
        ])->first();

        $user = null;

        if ($existing) {
            $existing->update(array_merge($candidateData, ['updated_by' => auth()->id()]));
            $record = $existing;
        } else {
            $record = NhidclResourceRequisitionFinalShortlistApplicant::create(array_merge($candidateData, [
                'nhidcl_resource_requisition_id' => $validated['nhidcl_resource_requisition_id'],
                'nhidcl_batches_id' => $validated['nhidcl_batches_id'],
                'ref_users_id' => $validated['ref_users_id'],
                'created_by' => auth()->id(),
            ]));
        }

        // Send offer letter mail only if status is Selected
        if ($validated['status'] === 'Selected') {
            $user = $user ?? User::find($validated['ref_users_id']);
            if ($user && $user->email) {
                //Mail::to("mayank.raghav@velocis.co.in")->send(new OfferLetterMail($user, $record));
                Mail::to($user->email)->send(new OfferLetterMail($user, $record));
            }
        }

        Alert::success('Success', 'Candidate status updated successfully.');
        return response()->json(['status' => 'success']);
    }

}
