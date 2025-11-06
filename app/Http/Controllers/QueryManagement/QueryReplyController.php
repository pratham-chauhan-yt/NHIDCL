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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Decrypt;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\NhidclApplicationStatus;
use App\Models\QueryManagement\QmsQueryDetails;
use App\Models\QueryManagement\QmsQueryReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QueryReplyController extends Controller
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
    public $path = 'uploads/qms-reply-file/';


    /**
     * Show the form for creating a new resource.
     */
    public function queryDetails($queryId, Request $request)
    {
        if ($request->ajax()) {
            $id = Crypt::decryptString($queryId);
            $query = QmsQueryReply::with(['createdBy:id,name,email'])->where('nhidcl_qms_query_details_id', $id)->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('message', function ($row) {
                    $plainText = $row->message;
                    $truncated = strlen($plainText) > 20
                        ? substr($plainText, 0, 20) . '...'
                        : $plainText;
                    return '<span class="truncated-msg">' . $truncated . '</span>' .
                        (strlen($plainText) > 20
                            ? ' <a href="#" class="show-more text-primary" data-fullmsg="' . e($plainText) . '">Show more</a>'
                            : '');
                })
                ->addColumn('replied_by', function ($row) {
                    return $row->createdBy ? $row->createdBy->name . '<br>(' . $row->createdBy->email . ')' : '-';
                })
                ->addColumn('replied_date', function ($row) {
                    return $row->created_at ? $row->created_at->format('d M Y') : '-';
                })
                ->addColumn('file', function ($row) {
                    if (!empty($row->file)) {
                        $filePath = 'uploads/qms-reply-file/';
                        $fileName = basename($row->file);
                        $fileUrl = route('qms.view-file', [
                            'pathName' => $filePath,
                            'fileName' => $fileName,
                        ]);

                        return '<a href="' . $fileUrl . '" target="_blank" title="View File">
                                    <i class="fa fa-file mx-1" aria-hidden="true"></i>
                                </a>';
                    } else {
                        return '<span>No file uploaded</span>';
                    }
                })
                ->rawColumns(['replied_by', 'file', 'message'])
                ->make(true);
        }
        $header = true;
        $sidebar = true;
        $id = decrypt($queryId);
        $queryDetails = QmsQueryDetails::with(['createdBy:id,name,email', 'status:id,status', 'queryType:id,query_type'])->where('id', $id)->first();
        return view("query-management.query-details", compact("header", "sidebar", "queryDetails"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string|max:300',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors()->all())->withInput();
            }

            $inputs = $request->all();
            $query = QmsQueryReply::create([
                'nhidcl_qms_query_details_id' => $inputs['query_details_id'],
                'message' => $inputs['description'],
                'file' => $inputs['reply_file'],
                'created_by' => user_id(),
            ]);
            if ($query) {
                Alert::success('Success', 'Your reply was submitted successfully!');
            } else {
                Alert::error('Error', 'Some error occured.Please try again');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function markAsResolved(Request $request)
    {
        $request->validate([
            'remark' => 'required|max:100',
            'remark' => 'required'
        ]);
        try {
            $statusName = 'resolved_query';
            $status = NhidclApplicationStatus::whereRaw('LOWER(status) = ?', [Str::lower($statusName)])->first();
            $query = QmsQueryDetails::findOrFail($request->query_id);
            $query->nhidcl_application_status_id = $status ? $status->id : null;
            $query->remark = $request->remark;
            $query->save();
            Alert::success('Success', 'Query marked as resolved.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::danger('Error', 'Failed to update query.');
            return redirect()->back();
        }
    }
}
