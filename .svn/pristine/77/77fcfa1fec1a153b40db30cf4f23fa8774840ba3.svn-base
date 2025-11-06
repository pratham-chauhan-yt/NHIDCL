<?php

namespace App\Http\Controllers\AuditManagement;

use App\Http\Controllers\Controller;
use App\Models\AuditManagement\AmsAuditQuery;
use App\Models\AuditManagement\AuditQueryPara;
use App\Models\AuditManagement\AuditQueryParaReply;
use App\Models\AuditManagement\AuditQueryParaReplyFile;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AuditParaReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ams-dashboard')->only(['dashboard']);
        $this->middleware('permission:ams-view')->only(['index']);
        $this->middleware('permission:ams-create')->only(['create', 'store']);
        $this->middleware('permission:ams-view')->only(['show', 'view']);
        $this->middleware('permission:ams-edit')->only(['edit', 'update']);
        $this->middleware(['role:Super Admin', 'module.permission:ams-delete'])->only(['destroy']);
    }
    public $path = 'uploads/audit-management/para-reply-files/';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $header = true;
        $sidebar = true;
        $auditParaId = Crypt::decrypt($id);
        if ($request->ajax()) {
            $query = AuditQueryParaReply::with(['createdBy', 'files'])->where('nhidcl_ams_audit_query_para_id', $auditParaId)->orderBy('id', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('remark', function ($row) {
                        $fullMessage = strip_tags($row->remark);
                        $truncated = strlen($fullMessage) > 20 ? substr($fullMessage, 0, 20) . '...' : $fullMessage;
                        return '<span class="truncated-msg">' . e($truncated) . '</span>' .
                            (strlen($fullMessage) > 20
                                ? ' <a href="#" class="show-more text-primary" data-fullmsg="' . htmlspecialchars($row->remark) . '">Show more</a>'
                                : '');
                    })
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->name . ' (' . $row->createdBy->email . ')';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y H:i') : '';
                })
                ->addColumn('files', function ($row) {
                    if ($row->files) {
                        $links = '';
                        $filePath = 'uploads/audit-management/para-reply-files/';
                        $fileName = $row->files->file;

                        $fileUrl = route('audit-management.view.files', [
                            'pathName' => $filePath,
                            'fileName' => $fileName,
                        ]);

                        $links .= '<a href="' . $fileUrl . '" target="_blank" title="View file" class="file-link" style="margin-right: 8px;">
                                        <i class="fa fa-file fa-2x" aria-hidden="true"></i>
                                    </a>';

                        return $links;
                    }
                    return 'No files';
                })

                ->rawColumns(['files', 'remark'])
                ->make(true);
        }
        $auditQueryPara = AuditQueryPara::with(['createdBy', 'assignTo', 'auditQuery', 'queryType', 'part'])->findorFail($auditParaId);
        return view('audit-management.nodal-officer.audit-para-details', compact('header', 'sidebar', 'auditQueryPara'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeAuditParaReply(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'remark' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error('Error', $validator->errors()->all());
                return redirect()->back()->withInput();
            }
            $inputs = $request->all();
            ## Create the reply
            $auditPara = AuditQueryParaReply::create([
                'nhidcl_ams_audit_query_para_id' => $inputs['audit_para_id'],
                'remark' => $inputs['remark'],
                'created_by' => user_id(),
            ]);
            #### Update the status of the related AuditQueryPara
            $para = AuditQueryPara::findOrFail($inputs['audit_para_id']);
            $para->ref_status_id = '6';
            $para->save();
            ## Store replied file
            if (isset($request->para_reply_file)) {
                AuditQueryParaReplyFile::create([
                    'nhidcl_ams_audit_query_para_replies_id' => $auditPara->id,
                    'file' => $request->para_reply_file,
                    'created_by' => user_id(),
                ]);
            }

            // if ($request->hasFile('files')) {
            //     foreach ($request->file('files') as $file) {
            //         $filename = time() . '_' . $file->getClientOriginalName();
            //         $destinationPath = public_path($this->path);

            //         if (!file_exists($destinationPath)) {
            //             mkdir($destinationPath, 0755, true);
            //         }

            //         $file->move($destinationPath, $filename);

            //         AuditQueryParaReplyFile::create([
            //             'nhidcl_ams_audit_query_para_replies_id' => $auditPara->id,
            //             'file' => $filename,
            //             'created_by' => user_id(),
            //         ]);
            //     }
            // }
            Alert::success('Success', 'Your reply has been submitted successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function uploadFile(Request $request)
    {
        $ext = $request->filled('ext') ? explode(',', $request->ext) : ['pdf'];
        $inputName = $request->input('input_name', 'para_reply_file');

        try {
            if ($request->ajax()) {
                if ($request->hasFile($inputName)) {
                    return storeMedia($request, $this->path, $ext, $inputName);
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
}
