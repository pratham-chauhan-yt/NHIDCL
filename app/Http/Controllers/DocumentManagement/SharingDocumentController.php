<?php

namespace App\Http\Controllers\DocumentManagement;


use App\Http\Requests\DocumentManagement\ShareRequest;
use App\Models\DocumentManagement\NhidclDmsShareDocument;
use App\Models\User;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class SharingDocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:dms-share|dms-approver'])
            ->only(['create', 'store', 'index', 'show', 'destroy']);
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $rendering = $request->get('rendering');

                $query = NhidclDmsShareDocument::query()
                    ->with(['user', 'status', 'creator', 'approver']);

                // Filter data based on tab type
                switch ($rendering) {
                    case 'Shared-Documents':
                        $query->where('nhidcl_dms_share_document.created_by', auth()->id())
                            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', 'nhidcl_dms_share_document.ref_users_id')
                            ->leftJoin('ref_users as approver_users', 'approver_users.id', '=', 'nhidcl_dms_share_document.approved_or_rejected_by')
                            ->select([
                                'nhidcl_dms_share_document.*',
                                'shared_with_users.name as shared_with_name',
                                'shared_with_users.email as shared_with_email',
                                'approver_users.name as approver_name',
                                'approver_users.email as approver_email',
                            ]);
                        break;

                    case 'Received-Documents':
                        $query->where('nhidcl_dms_share_document.ref_users_id', auth()->id())
                            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', 'nhidcl_dms_share_document.created_by')
                            ->select([
                                'nhidcl_dms_share_document.*',
                                'shared_by_users.name as shared_by_name',
                                'shared_by_users.email as shared_by_email',
                            ]);
                        break;

                    case 'Approval-Pending':
                        $query->where('nhidcl_dms_share_document.ref_status_id', 1)
                            ->whereHas('creator', function ($q) {
                                $q->where('dms_approver_id', auth()->id());
                            })
                            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', 'nhidcl_dms_share_document.ref_users_id')
                            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', 'nhidcl_dms_share_document.created_by')
                            ->select([
                                'nhidcl_dms_share_document.*',
                                'shared_with_users.name as shared_with_name',
                                'shared_with_users.email as shared_with_email',
                                'shared_by_users.name as shared_by_name',
                                'shared_by_users.email as shared_by_email',
                            ]);
                        break;

                    case 'Approved-Archive':
                        $query->whereIn('nhidcl_dms_share_document.ref_status_id', [3, 4])
                            ->where('nhidcl_dms_share_document.approved_or_rejected_by', auth()->id())
                            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', 'nhidcl_dms_share_document.ref_users_id')
                            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', 'nhidcl_dms_share_document.created_by')
                            ->select([
                                'nhidcl_dms_share_document.*',
                                'shared_with_users.name as shared_with_name',
                                'shared_with_users.email as shared_with_email',
                                'shared_by_users.name as shared_by_name',
                                'shared_by_users.email as shared_by_email',
                            ]);
                        break;
                }

                if (!$request->has('order')) {
                    $query->orderBy('nhidcl_dms_share_document.id', 'desc');
                }

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('shared_with', function ($row) {
                        return $row->user
                            ? $row->user->name . ' (' . $row->user->email . ')'
                            : '-';
                    })
                    ->filterColumn('shared_with', function ($query, $keyword) {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('shared_with_users.name', 'ilike', "%{$keyword}%")
                                ->orWhere('shared_with_users.email', 'ilike', "%{$keyword}%");
                        });
                    })

                    ->orderColumn('shared_with', function ($query, $order) {
                        $query->orderBy('shared_with_users.name', $order)
                            ->orderBy('shared_with_users.email', $order);
                    })


                    ->editColumn('shared_by', function ($row) {
                        return $row->creator
                            ? $row->creator->name . ' (' . $row->creator->email . ')'
                            : '-';
                    })
                    ->filterColumn('shared_by', function ($query, $keyword) {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('shared_by_users.name', 'ilike', "%{$keyword}%")
                                ->orWhere('shared_by_users.email', 'ilike', "%{$keyword}%");
                        });
                    })

                    ->orderColumn('shared_by', function ($query, $order) {
                        $query->orderBy('shared_by_users.name', $order)
                            ->orderBy('shared_by_users.email', $order);
                    })

                    ->editColumn('approved_by', function ($row) {
                        return $row->approver
                            ? $row->approver->name . ' (' . $row->approver->email . ')'
                            : '-';
                    })
                    ->filterColumn('approved_by', function ($query, $keyword) {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('approver_users.name', 'ilike', "%{$keyword}%")
                                ->orWhere('approver_users.email', 'ilike', "%{$keyword}%");
                        });
                    })
                    ->orderColumn('approved_by', function ($query, $order) {
                        $query->orderBy('approver_users.name', $order)
                            ->orderBy('approver_users.email', $order);
                    })

                    ->editColumn('created_at', function ($row) {
                        return $row->created_at ? $row->created_at->format('d-m-Y') : '';
                    })
                    ->filterColumn('created_at', function ($query, $keyword) {
                        $normalized = str_replace(['/', '-'], '%', $keyword);

                        $query->where(function ($q) use ($normalized, $keyword) {
                            $q->where('nhidcl_dms_share_document.created_at', 'ilike', "%{$keyword}%")
                                ->orWhereRaw("to_char(nhidcl_dms_share_document.created_at, 'DD-MM-YYYY') ILIKE ?", ["%{$normalized}%"])
                                ->orWhereRaw("to_char(nhidcl_dms_share_document.created_at, 'DD/MM/YYYY') ILIKE ?", ["%{$normalized}%"]);
                        });
                    })
                    ->orderColumn('created_at', function ($query, $order) {
                        $query->orderBy('nhidcl_dms_share_document.created_at', $order);
                    })

                    ->editColumn('status', function ($row) {
                        $statusType = strtolower($row->status?->type ?? '');

                        if ($row->share_type === 'Within Department') {
                            return '-';
                        }
                        return match ($statusType) {
                            'rejected' => '<span data-popover-target="popover-' . $row->id . '"
                                            class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-700 cursor-pointer">
                                            Rejected
                                        </span>
                                        <div data-popover id="popover-' . $row->id . '" role="tooltip" class="absolute z-10 invisible w-72 text-wrap p-2 m-2 bg-gray-100 rounded-lg shadow-2xl border border-gray-200 dark:bg-gray-800">
                                    <div class="bg-gray-400 border-b border-gray-600 rounded dark:border-gray-800 dark:bg-gray-900 p-1">
                                        <h3 class="font-bold ps-1">Approver Remark</h3>
                                    </div>
                                    <div class="bg-blue-100 rounded mt-1 py-2 px-1">
                                        <p class="text-blue-600">' . (!empty($row->approver_remark) ? e($row->approver_remark) : 'No remark provided') . '</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                    ',
                            'approved' => '<span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">Approved</span>',
                            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-700">Pending</span>',
                            default => '<span class="px-2 py-1 text-xs font-semibold rounded bg-gray-100 text-gray-700">' . e($row->status?->type ?? 'N/A') . '</span>',
                        };
                    })
                    ->addColumn('file', function ($row) {
                        if ($row->document) {
                            $prev = $row->document ?? null;
                            $fileUrl = route('dms.viewSharedFiles', [
                                'pathName' => $row->document_filepath,
                                'fileName' => $row->document
                            ]);
                            return '<a href="' . $fileUrl . '" target="_blank" class="btn btn-sm btn-primary text-sm">View</a>';
                        }
                        return '-';
                    })
                    ->addColumn('action', function ($row) use ($rendering) {
                        $buttons = '';
                        if (auth()->user()->can('dms-share') && $row->created_by == auth()->id() && $rendering == "Shared-Documents") {
                            if (!in_array($row->ref_status_id, [3, 4], true))
                                $buttons .= '<a href="' . route('dms.sharing.edit', Crypt::encrypt($row->id)) . '" class="btn btn-sm btn-warning text-sm me-1">Edit</a>';

                            $buttons .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                            <form id="delete-form-' . $row->id . '" action="' . route('dms.sharing.destroy', Crypt::encrypt($row->id)) . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                        } else if (auth()->user()->can('dms-approver') && $row->creator->dms_approver_id == auth()->id() && $rendering == "Approval-Pending") {
                            $buttons .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm approvedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmApprove(\'' . Crypt::encrypt($row->id) . '\')">Approve</a>';

                            $buttons .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm rejectdata" onclick="confirmReject(\'' . Crypt::encrypt($row->id) . '\')">Reject</a>';
                        }
                        return $buttons ?: '-';
                    })
                    ->rawColumns(['status', 'file', 'action'])
                    ->make(true);
            }

            $header = true;
            $sidebar = true;
            return view("document-management.sharing-document.received-document", compact("header", "sidebar"));
        } catch (Exception $e) {
            Log::error('Error occurred while fetching received documents: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->share_type == 'Within Department') {
                $users = User::where('is_nhidcl_employee', true)
                    ->where('ref_department_id', auth()->user()->ref_department_id)
                    ->where('id', '!=', auth()->id())
                    ->orderBy('name', 'asc')
                    ->select('id', 'name', 'email')
                    ->get();

                return response()->json(['users' => $users]);
            } else {
                $users = User::where('is_nhidcl_employee', true)
                    ->where('ref_department_id', '!=', auth()->user()->ref_department_id)
                    ->where('id', '!=', auth()->id())
                    ->orderBy('name', 'asc')
                    ->select('id', 'name', 'email')
                    ->get();

                return response()->json(['users' => $users]);
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'users' => $this->getShareableUsers($request->share_type),
            ]);
        }

        $header = true;
        $sidebar = true;

        return view("document-management.sharing-document.share-document", compact("header", "sidebar"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShareRequest $request)
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->id();
            if (!empty($request->upload_doc_url)) {
                $doc = extractFileDetails($request->upload_doc_url);
                $data['document'] = $doc["fileName"] ?? null;
                $data['document_filepath'] = $doc["filePath"] ?? null;
            }
            if ($request->share_type === 'Other Department') {
                $data['ref_status_id'] = auth()->user()->dms_approver_id ? 1 : 3;
            }
            Log::info('DMS - Sharing document with data: ', $data);
            NhidclDmsShareDocument::create($data);
            Alert::success('Success', 'Document shared successfully');
            return redirect()->route('dms.sharing.create')->with('success', 'Document shared successfully!');
        } catch (Exception $e) {
            Log::error('Error occurred while sharing document: ' . $e->getMessage());
            return redirect()->route('dms.sharing.create')->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('dms.sharing.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $header = true;
        $sidebar = true;
        $document = NhidclDmsShareDocument::findOrFail(Crypt::decrypt($id));
        return view("document-management.sharing-document.edit-shared-document", compact("header", "sidebar", "document"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShareRequest $request, $id)
    {
        try {
            if ($request->ajax()) {
                return $this->handleAjaxUpdate($request);
            }
            $data = NhidclDmsShareDocument::findOrFail(Crypt::decrypt($id));

            if ($data->share_type === "Other Department" && in_array($data->ref_status_id, [3, 4], true)) {
                Alert::info('Error', 'You cannot change an approved or rejected document.');
                return redirect()->route('dms.sharing.edit', $id);
            }
            $data->fill($request->validated());

            $data['updated_by'] = auth()->id();
            if (!empty($request->upload_doc_url)) {
                $doc = extractFileDetails($request->upload_doc_url);
                $data['document'] = $doc["fileName"] ?? null;
                $data['document_filepath'] = $doc["filePath"] ?? null;
            }
            $data->save();
            Alert::success('Success', 'Document updated successfully');
            return redirect()->route('dms.sharing.create')->with('success', 'Document updated successfully.');
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('dms.sharing.create', $id)->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $document = NhidclDmsShareDocument::find(Crypt::decrypt($id));

            if (!$document) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('dms.sharing.create')
                    ->withInput()
                    ->withErrors(['msg' => 'Something went wrong, Please try again.']);
            }

            // Set updated_by before deleting
            $document->updated_by = auth()->id();
            $document->is_deleted = true;
            $document->save();

            $document->delete(); // Soft delete (sets deleted_at)

            Alert::success('Success', 'Shared Document deleted successfully');
            return redirect()->route('dms.sharing.create')->with('success', 'Shared Document deleted successfully');
        } catch (Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('dms.sharing.create')
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function pendingAndApprovedDocuments()
    {
        $header = true;
        $sidebar = true;
        return view("document-management.sharing-document.approve-document", compact("header", "sidebar"));
    }

    public function storeSharedDocument(Request $request, FileService $fileService)
    {
        $allowedFileSize = 40 * 1024 * 1024; // 40MB
        return $fileService->store($request, 'uploads/document-management/shared/', 'upload_doc', $allowedFileSize);
    }

    public function viewSharedFiles(Request $request, FileService $fileService)
    {
        return $fileService->viewFile($request->pathName, $request->fileName, 'viewSharedFiles');
    }

    private function getShareableUsers(string $shareType)
    {
        $query = User::where('is_nhidcl_employee', true)
            ->where('id', '!=', auth()->id())
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'email');

        if ($shareType === 'Within Department') {
            $query->where('ref_department_id', auth()->user()->ref_department_id);
        } else {
            $query->where('ref_department_id', '!=', auth()->user()->ref_department_id);
        }

        return $query->get();
    }

    protected function handleAjaxUpdate(ShareRequest $request)
    {
        $documentId = Crypt::decrypt($request->id);
        $document = NhidclDmsShareDocument::find($documentId);

        if (!$document || !$request->ref_status_id) {
            return response()->json([
                'message' => 'Document not found or invalid status.',
            ], 404);
        }

        $document->update([
            'approved_or_rejected_by' => auth()->id(),
            'ref_status_id' => $request->ref_status_id,
            'approver_remark' => $request->approver_remark,
        ]);

        $message = $request->ref_status_id == 3
            ? 'Shared Document approved successfully.'
            : 'Shared Document rejected successfully.';

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
