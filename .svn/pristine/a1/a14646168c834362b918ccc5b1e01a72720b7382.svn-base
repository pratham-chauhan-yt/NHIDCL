<?php

namespace App\Http\Controllers\QueryManagement;

use App\Http\Requests\DocumentManagement\ShareRequest;
use App\Models\User;
use App\Services\FileService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\NhidclApplicationStatus;
use App\Models\QueryManagement\QmsQueryDetails;
use App\Models\QueryManagement\QmsRefQueryType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class QueryManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:qms-dashboard|qms-add-query|qms-knowladge-base-query|qms-raised-query'])
            ->only(['create', 'store', 'index', 'show', 'destroy']);
        $this->middleware(function ($request, $next) {
            session(['moduleName' => 'Query Management System']);
            return $next($request);
        });
    }

    public function dashboard()
    {
        $header = true;
        $sidebar = true;
        $totalQueries = QmsQueryDetails::count();
        $pendingStatusId = NhidclApplicationStatus::whereRaw('LOWER(status) = ?', ['pending_query'])->value('id');
        $pendingQueries = QmsQueryDetails::where('nhidcl_application_status_id', $pendingStatusId)->count();
        $resolvedStatusId = NhidclApplicationStatus::whereRaw('LOWER(status) = ?', ['resolved_query'])->value('id');
        $resolvedQueries = QmsQueryDetails::where('nhidcl_application_status_id', $resolvedStatusId)->count();
        return view("query-management.dashboard", compact("header", "sidebar", "totalQueries", "pendingQueries", "resolvedQueries"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $statusName = strtolower($request->get('status'));
            $statusRecord = NhidclApplicationStatus::whereRaw('LOWER(status) = ?', [$statusName])->first();
            $query = QmsQueryDetails::with(['queryType:id,query_type'])->where('nhidcl_application_status_id', $statusRecord->id)->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('query_type', function ($row) {
                    return $row->queryType ? $row->queryType->query_type : '-';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d M Y') : '-';
                })
                ->addColumn('action', function ($row) use ($statusName) {
                    $viewRoute = route('qms.view-query', Crypt::encrypt($row->id));
                    $actions = '<a href="' . $viewRoute . '" class="btn btn-sm btn-primary">View</a>';
                    if (auth()->user()->can('qms-resolve-query') && ($statusName != 'resolved_query')) {
                        $actions .= '
                            <button type="button" class="btn btn-sm btn-warning openMarkAsResolvedModalBtn"
                                data-id="' . $row->id . '"
                                title="Mark as Resolved">
                                Mark as Resolve
                            </button>
                        ';
                    }
                    return $actions;
                })

                ->rawColumns(['action', 'query_type'])
                ->make(true);
        }
        $queryTypes = QmsRefQueryType::get();
        $header = true;
        $sidebar = true;
        return view("query-management.add-query", compact("header", "sidebar", "queryTypes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:150',
                'query_type' => 'required',
                'description' => 'required|string|max:250',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors()->all())->withInput();
            }

            $inputs = $request->all();
            $statusName = 'pending_query';
            $status = NhidclApplicationStatus::whereRaw('LOWER(status) = ?', [Str::lower($statusName)])->first();
            $query = QmsQueryDetails::create([
                'title' => $inputs['title'],
                'query_type' => $inputs['query_type'],
                'description' => $inputs['description'],
                'supporting_document' => $inputs['query_file'],
                'created_by' => user_id(),
                'nhidcl_application_status_id' => $status ? $status->id : null
            ]);
            $yearSuffix = Carbon::now()->format('y');
            $queryId = str_pad($query->id, 2, '0', STR_PAD_LEFT);
            // Update query_id
            $query->query_id = "NHIDCL-QMS-" . $yearSuffix . "-" . $queryId;
            $query->save();
            Alert::success('Success', 'Query has been created successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function upload(Request $request)
    {
        // $ext = $request->filled('ext') ? explode(',', $request->ext) : ['pdf'];
        $ext = $request->filled('ext') ? array_map('trim', explode(',', $request->ext)) : ['pdf'];
        $inputName = $request->input('input_file_name');
        $path =  $request->input('file_path');
        try {
            if ($request->ajax()) {
                if ($request->hasFile($inputName)) {
                    return storeMedia($request, $path, $ext, $inputName);
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
            $currentUrl = $request->fullUrl();
            $referer = $request->headers->get('referer');

            if ($referer && $referer !== $currentUrl) {
                Alert::error('Sorry', 'File not found.');
                return redirect($referer)->with('error', 'File not found.');
            }
            Alert::error('Sorry', 'File not found.');
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function view($id)
    {
        $queryId = Crypt::decrypt($id);
        $header = true;
        $sidebar = true;
        $data = QmsQueryDetails::with(['createdBy:id,name,email', 'status:id,status', 'queryType:id,query_type'])->where('id', $queryId)->first();
        return view("query-management.view-query", compact("header", "sidebar", "data"));
    }

    public function raisedQuery(Request $request)
    {
        if ($request->ajax()) {
            $query = QmsQueryDetails::with(['createdBy:id,name,email', 'status:id,status', 'queryType:id,query_type'])->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('query_type', function ($row) {
                    return $row->queryType ? $row->queryType->query_type : '-';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d M Y') : '-';
                })
                ->addColumn('query_raised_by', function ($row) {
                    return $row->createdBy ? $row->createdBy->name . "<br>(" . $row->createdBy->email . ")" : '-';
                })
                ->addColumn('status', function ($row) {
                    $status = '';
                    if (strcasecmp($row->status->status, 'Pending_query') === 0) {
                        $status .= '<span class="badge badge-warning">Pending</span>';
                    } elseif(strcasecmp($row->status->status, 'Resolved_query') === 0) {
                        $status .= ' <button type="button" class="btn btn-info btn-sm queryResolved"
                            data-remark="' . $row->remark . '"
                            title="Already Resolved">
                           Already Resolved
                        </button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $action = '<a href="' . route('qms.query-details', Crypt::encrypt($row->id)) . '" class="btn btn-sm btn-primary">View</a>';
                    if (auth()->user()->can('qms-resolve-query')) {
                        if (!isset($row->remark)) {
                            $action .= ' <button type="button" class="btn btn-warning btn-sm openMarkAsResolvedModalBtn"
                                data-id="' . $row->id . '"
                                title="Mark as Resolved">
                                Mark as Resolved
                            </button>';
                        } else {
                            $action .= '';
                        }
                    }
                    return $action;
                })
                ->rawColumns(['action', 'query_raised_by', 'status'])
                ->make(true);
        }
        $header = true;
        $sidebar = true;
        return view("query-management.raised-query", compact("header", "sidebar"));
    }
}
