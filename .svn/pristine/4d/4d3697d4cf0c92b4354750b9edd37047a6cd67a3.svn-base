<?php

namespace App\Http\Controllers\DocumentManagement;


use App\Models\DepartmentMaster;
use App\Models\DocumentManagement\NhidclDmsUploadOfficeOrder;
use App\Models\DocumentManagement\RefType;
use App\Models\DocumentManagement\RefTypeOfDocument;
use App\Models\RefPassingYear;
use App\Models\User;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentManagement\UploadRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UploadDocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:dms-dashboard", ["only" => ["dashboard"]]);
        $this->middleware('permission:dms-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:dms-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dms-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dms-delete', ['only' => ['destroy']]);
    }

    public function dashboard()
    {
        $header = true;
        $sidebar = true;
        return view("document-management.dashboard", compact("header", "sidebar"));
    }

    public function index(Request $request)
    {
        $header = TRUE;
        $sidebar = TRUE;

        if ($request->ajax()) {
            $rendering = $request->get('rendering');

            $query = NhidclDmsUploadOfficeOrder::query()
                ->with(['typeOfDocument', 'type', 'department', 'passingYear']);

            // Filter data based on tab type
            switch ($rendering) {
                case 'Office-Order':
                    $query->whereHas('typeOfDocument', function ($q) {
                        $q->where('document_type', 'Office Order');
                    })
                        ->leftJoin('ref_users', 'ref_users.id', '=', 'nhidcl_dms_upload_office_order.tag_user')
                        ->addSelect(
                            'nhidcl_dms_upload_office_order.*',
                            'ref_users.name as tagged_user_name',
                            'ref_users.email as tagged_user_email'
                        );
                    break;

                case 'SOP':
                    $query->whereHas('typeOfDocument', function ($q) {
                        $q->where('document_type', 'SOP');
                    });
                    break;

                case 'Policy':
                    $query->whereHas('typeOfDocument', function ($q) {
                        $q->where('document_type', 'Policy');
                    });
                    break;

                case 'Circular':
                    $query->whereHas('typeOfDocument', function ($q) {
                        $q->where('document_type', 'Circular');
                    });
                    break;

                case 'IS-Codes':
                    $query->whereHas('typeOfDocument', function ($q) {
                        $q->where('document_type', 'Other');
                    });
                    break;
            }

            if (!$request->has('order')) {
                $query->orderBy('id', 'desc');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('file_number', fn($row) => $row->file_number ?? '')

                ->editColumn('issue_date', fn($row) => $row->issue_date ? $row->issue_date->format('d-m-Y') : '')
                ->filterColumn('issue_date', function ($query, $keyword) {
                    // Normalize keyword by replacing hyphens/slashes to handle multiple formats
                    $normalized = str_replace(['/', '-'], '%', $keyword);

                    // Search both formatted and raw DB date
                    $query->where(function ($q) use ($normalized, $keyword) {
                        // Match against original DB format (YYYY-MM-DD)
                        $q->where('issue_date', 'ilike', "%{$keyword}%")
                            // Match against formatted display (DD-MM-YYYY)
                            ->orWhereRaw("to_char(issue_date, 'DD-MM-YYYY') ILIKE ?", ["%{$normalized}%"])
                            // Also match against DD/MM/YYYY format
                            ->orWhereRaw("to_char(issue_date, 'DD/MM/YYYY') ILIKE ?", ["%{$normalized}%"]);
                    });
                })

                ->editColumn('ref_department_id', fn($row) => $row->department?->name ?? '')
                ->editColumn('ref_type_id', fn($row) => $row->type?->type ?? '')
                ->editColumn('year', fn($row) => $row->passingYear?->passing_year ?? '')

                ->editColumn('tagged_user_name', function ($row) use ($rendering) {
                    if ($rendering === 'Office-Order') {
                        if ($row->tagged_user_name && $row->tagged_user_email) {
                            return $row->tagged_user_name . ' (' . $row->tagged_user_email . ')';
                        }
                        return $row->tagged_user_name ?? '';
                    }
                    return '';
                })

                ->filterColumn('tagged_user_name', function ($query, $keyword) use ($rendering) {
                    if ($rendering === 'Office-Order') {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('ref_users.name', 'ilike', "%{$keyword}%")
                                ->orWhere('ref_users.email', 'ilike', "%{$keyword}%");
                        });
                    }
                })

                ->addColumn('file', function ($row) {
                    if ($row->document) {
                        $prev = $row->document ?? null;
                        $fileUrl = $prev ? 'viewFiles?pathName=' . $row->document_filepath . '&fileName=' . $row->document : '#';
                        return '<a href="' . $fileUrl . '" target="_blank" class="btn btn-sm btn-primary text-sm">View</a>';
                    }
                    return '-';
                })
                ->addColumn('action', function ($row) {
                    $buttons = '';
                    if (auth()->user()->can('dms-edit')) {
                        $buttons .= '<a href="' . route('dms.document.edit', Crypt::encrypt($row->id)) . '" class="btn btn-sm btn-warning text-sm me-1">Edit</a>';
                    }
                    if (auth()->user()->can('dms-delete')) {
                        $buttons .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                        <form id="delete-form-' . $row->id . '" action="' . route('dms.document.destroy', Crypt::encrypt($row->id)) . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    };
                    return $buttons ?: '-';
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }
        return view("document-management.view-document", compact("header", "sidebar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header = true;
        $sidebar = true;

        $document_types = RefTypeOfDocument::orderBy('document_type', 'asc')->get();
        $ref_types = RefType::orderBy('type', 'asc')->get();
        $departments = DepartmentMaster::orderBy('name', 'asc')->get();
        $document_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
        $users = User::where('is_nhidcl_employee', true)
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'email')
            ->get();

        return view("document-management.add-document", compact("header", "sidebar", "document_types", "ref_types", "document_years", "users", "departments"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadRequest $request)
    {
        try {
            Log::info('DMS - Request to upload document with data: ', $request->all());
            $data = $request->validated();

            $data['created_by'] = auth()->id();
            if (!empty($request->upload_doc_url)) {
                $marksheet = extractFileDetails($request->upload_doc_url);
                $data['document'] = $marksheet["fileName"] ?? null;
                $data['document_filepath'] = $marksheet["filePath"] ?? null;
            }
            Log::info('DMS - Uploading document with data: ', $data);
            NhidclDmsUploadOfficeOrder::create($data);
            Alert::success('Success', 'Document uploaded successfully');
            return redirect()->route('dms.document.create')->with('success', 'Document uploaded successfully!');
        } catch (Exception $e) {
            Log::error('DMS - Error uploading document: ', ['error' => $e->getMessage()]);
            return redirect()->route('dms.document.create')->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        redirect()->route('dms.document.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $header = true;
        $sidebar = true;

        $document = NhidclDmsUploadOfficeOrder::findOrFail(Crypt::decrypt($id));

        $document_types = RefTypeOfDocument::orderBy('document_type', 'asc')->get();
        $ref_types = RefType::orderBy('type', 'asc')->get();
        $departments = DepartmentMaster::orderBy('name', 'asc')->get();
        $document_years = RefPassingYear::orderBy('passing_year', 'desc')->get();
        $users = User::where('is_nhidcl_employee', true)
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'email')
            ->get();

        return view("document-management.edit-document", compact("header", "sidebar", "document", "document_types", "ref_types", "document_years", "users", "departments"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UploadRequest $request, $id)
    {
        try {
            Log::info('DMS - Request to update document with data: ', $request->all());
            $documentId = Crypt::decrypt($id);
            $data = NhidclDmsUploadOfficeOrder::findOrFail($documentId);
            $data->fill($request->validated());

            $data['updated_by'] = auth()->id();
            if (!empty($request->upload_doc_url)) {
                $marksheet = extractFileDetails($request->upload_doc_url);
                $data['document'] = $marksheet["fileName"] ?? null;
                $data['document_filepath'] = $marksheet["filePath"] ?? null;
            }
            Log::info("DMS - Updating document ID {$documentId} with data: ", $data->toArray());
            $data->save();
            Alert::success('Success', 'Document updated successfully');
            return redirect()->route('dms.document.index')->with('success', 'Document updated successfully.');
        } catch (Exception $e) {
            Log::error('DMS - Error updating document: ', ['error' => $e->getMessage()]);
            return redirect()->route('dms.document.create')->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $document = NhidclDmsUploadOfficeOrder::find(Crypt::decrypt($id));

            if (!$document) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('dms.document.index')
                    ->withInput()
                    ->withErrors(['msg' => 'Something went wrong, Please try again.']);
            }

            // Set updated_by before deleting
            $document->updated_by = auth()->id();
            $document->is_deleted = true;
            $document->save();

            $document->delete(); // Soft delete (sets deleted_at)

            Alert::success('Success', 'Document deleted successfully');
            return redirect()->route('dms.document.index')->with('success', 'Document deleted successfully');
        } catch (Exception $e) {
            Log::error('DMS - Error deleting document: ', ['error' => $e->getMessage()]);
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('dms.document.index')
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function storeDocument(Request $request, FileService $fileService)
    {
        $allowedFileSize = 20 * 1024 * 1024; // 20MB
        return $fileService->store($request, 'uploads/document-management/upload/', 'upload_doc', $allowedFileSize);
    }

    public function viewFiles(Request $request, FileService $fileService)
    {
        return $fileService->viewFile($request->pathName, $request->fileName, 'viewFiles');
    }
}
