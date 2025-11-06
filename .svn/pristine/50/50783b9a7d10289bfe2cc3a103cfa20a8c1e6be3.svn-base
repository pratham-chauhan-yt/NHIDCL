<?php

namespace App\Http\Controllers\AuditManagement;

use App\Http\Controllers\Controller;
use App\Models\AuditManagement\AmsAuditQuery;
use App\Models\AuditManagement\AuditQueryPara;
use App\Models\RefAuditLevel;
use App\Models\RefAuditType;
use App\Models\RefProjectState;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AuditParaController extends Controller
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
    public $path = 'uploads/audit-management/para/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $query = AuditQueryPara::with(['createdBy']);
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->name ?? 'N/A';
                })
                ->addColumn('status', function ($row) {
                    $status = $row->ref_status_text ?? 'N/A';
                    $badgeClass = 'danger';
                    switch ($status) {
                        case 'Reply Pending':
                            $badgeClass = 'badge-warning';
                            break;
                        case 'Replied':
                            $badgeClass = 'badge-success';
                            break;
                        case 'Dropped':
                            $badgeClass = 'badge-secondary';
                            break;
                        default:
                            $badgeClass = 'badge-danger';
                            break;
                    }
                    return '<span class="badge p-2 ' . $badgeClass . '">' . $status . '</span>';

                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('audit-management.view', Crypt::encrypt($row->id)) . '"><i class="fa fa-eye"></i></a>
                        <a href="' . route('audit-management.edit', Crypt::encrypt($row->id)) . ' "><i class="fa fa-pencil"></i></a>';
                })
                ->editColumn('letter_date', function ($row) {
                    return $row->letter_date ? $row->letter_date : '';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('audit-management.nodal-officer.view-audit-queries', compact('sidebar', 'header'));
    }


    public function getLetterNo(Request $request)
    {
        $year = $request->year;
        $queries = AmsAuditQuery::where('audit_year', $year)->select('id', 'letter_no')->orderBy('letter_no')->get();
        return response()->json($queries);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeAuditPara(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'audit_para_year' => 'required',
                'para_letter_no' =>  'required',
                'title' => 'required',
                'brief_para' => 'required',
                'query_type' => 'required',
                'ref_part_id' => 'required',
                'office' => 'required',
                'department' => 'required',
                'assign_to' => 'required',
                'para_pdf_file' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors()->all())->withInput();
            }

            $inputs = $request->all();
            AuditQueryPara::create([
                'year' => $inputs['audit_para_year'],
                'nhidcl_ams_audit_query_id' => $inputs['para_letter_no'],
                'title' => $inputs['title'],
                'brief_para' => $inputs['brief_para'],
                'ref_query_type_id' => $inputs['query_type'],
                'ref_part_id' => $inputs['ref_part_id'],
                'ref_office_id' => $inputs['office'],
                'ref_department_id' => $inputs['department'],
                'assign_to' => $inputs['assign_to'],
                'created_by' => user_id(),
                'pdf_file_path' => $inputs['para_pdf_file'],
                'word_file_path' => $inputs['para_word_file'],
                'ref_status_id' => '8'   //  Default value Reply Pending  '8' => 'Reply Pending', '6' => 'Replied', '5' => 'Dropped',
            ]);
            Alert::success('Success', 'Audit Query para created successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function uploadFile(Request $request)
    {
        $ext = $request->filled('ext') ? explode(',', $request->ext) : ['pdf'];
        $inputName = $request->input('input_name', 'para_pdf_file');
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

    public function getUsersByDepartment(Request $request)
    {
        $departmentId = $request->input('department_id');
        // $users = User::role('Resource Pool User')->where('ref_department_id', $departmentId)->select('id', 'name', 'email')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Resource Pool User');
        })
            ->where('ref_department_id', $departmentId)
            ->select('id', 'name', 'email')
            ->get();
        return response()->json($users);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function dropPara(Request $request)
    {
        $para = AuditQueryPara::findOrFail($request->id);
        $para->ref_status_id = $request->status_id;
        $para->status_dropped_date = now();
        $para->save();
        $auditQuery = AmsAuditQuery::find($para->nhidcl_ams_audit_query_id);
        $allDropped = AuditQueryPara::where('nhidcl_ams_audit_query_id', $auditQuery->id)->where('ref_status_id', '!=', $request->status_id)->doesntExist();
        if ($allDropped) {
            $auditQuery->ref_status_id = $request->status_id;
            $auditQuery->status_dropped_date = now();
            $auditQuery->save();
        }

        return response()->json(['success' => true]);
    }
}
