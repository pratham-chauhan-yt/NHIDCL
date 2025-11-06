<?php

namespace App\Http\Controllers\GrievanceManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grievance;
use App\Models\GrievanceLog;
use App\Models\User;
use App\Models\DepartmentMaster;
use App\Models\DesignationMaster;
use App\Notifications\GrievanceAssigned;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Log;

class GrievanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Super Admin|HR|General Manager|Manager|Employee', 'module.access:Grievance Management']);
        $this->middleware(function ($request, $next) {
            session(['moduleName' => 'Grievance Management System']);
            return $next($request);
        });
    }

    public function dashboard()
    {   
        $user = auth()->user();
        if ($user->hasAnyRole(['Super Admin','HR'])) {
            $baseQuery = Grievance::orderBy('id');
        }else{
            $baseQuery = Grievance::where(function($q) use ($user) {
                $q->where('ref_users_id', $user->id)
                ->orWhere('ref_assign_users_id', $user->id);
            });
        }
        // Clone base query for listing
        $grievances = (clone $baseQuery)->latest()->get();

        // Counts in one go
        $total   = (clone $baseQuery)->count();
        $pending = (clone $baseQuery)->where('status', 'open')->count();
        $closed  = (clone $baseQuery)->where('status', 'closed')->count();
        $resolved  = (clone $baseQuery)->where('status', 'resolved')->count();
        $feedback  = (clone $baseQuery)->whereNotNull('feedback_remarks')->count();
        $header = true;
        $sidebar = true;
        return view("grievance-management.home", compact("header", "sidebar", "total", "pending", "closed", "resolved", "feedback"));
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $user = $request->user();
            if ($user->hasAnyRole(['Super Admin','HR'])) {
                $grievances = Grievance::latest()->get();
            } else {
                $grievances = Grievance::with('employee', 'assigned', 'designation', 'department')->where('ref_users_id', $user->id)
                ->orWhere('ref_assign_users_id', $user->id)
                ->latest()
                ->get();
            }
            return DataTables::of($grievances)
                ->addIndexColumn()
                ->addColumn('grievance_id', function ($row) {
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $viewUrl = route('grievance-management.grievance.details', $id);
                    return '<a href="'.$viewUrl.'" class="text-hover">'.$row->grievance_id.'</a>';
                })
                ->addColumn('ref_designation_id', function ($row) {
                    return $row?->designation?->name ?? 'N/A';
                })
                ->addColumn('ref_department_id', function ($row) {
                    return $row?->department?->name ?? 'N/A';
                })
                ->addColumn('ref_assign_users_id', function ($row) {
                    return $row?->assigned?->name ?? 'N/A';
                })
                ->addColumn('type', function ($row) {
                    $type = $row->type;
                    $label = ucwords(str_replace('_', ' ', $type));
                    return $label;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize
                    $colorClass = match (strtolower($status)) {
                        'escalated' => 'badge-primary',
                        'under_review' => 'badge-warning',
                        'resolved' => 'badge-success',
                        default => 'badge-info',
                    };
                    return '<span class="badge '.$colorClass.'">' . ucwords(str_replace('_', ' ', $label)) . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $pathName    = $row->upload_file_path;   // e.g. "uploads/grievance-management/documents/"
                    $fileName    = $row->upload_file;        // e.g. "68c3bbedd8dd9_tarunmahajanprofile.pdf"
                    $viewFileUrl = route('grievance-management.view.files', [
                        'pathName' => $pathName,
                        'fileName' => $fileName
                    ]);

                    $btns  = '<div class="inline-flex">';
                        $btns .= '<a href="' . $viewFileUrl . '" class="btn btn-sm btn-primary" target="_blank">Document</a>';
                    $btns .= '</div>';
                    return $btns;
                })

                ->rawColumns(['grievance_id','status', 'action'])
                ->make(true);
        }
        $header = true;
        $sidebar = true;
        return view("grievance-management.index", compact("header", "sidebar"));
    }

    public function create(){
        $header = true;
        $sidebar = true;
        $department = DepartmentMaster::orderBy('name', 'asc')->get();
        $designation = DesignationMaster::orderBy('name', 'asc')->get();
        return view("grievance-management.create", compact("header", "sidebar", "department", "designation"));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'employee_code' => 'required|string|max:50',
            'ref_designation_id' => 'required|integer|exists:ref_designation,id',
            'ref_department_id' => 'required|integer|exists:ref_department,id',
            'pay_scale' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'message' => 'required|string',
            'upload_files' => 'required|string'
        ]);
        $data['ref_users_id'] = $request->user()->id;
        $data['ref_assign_users_id'] = $request->user()->id;
        $data['escalation_level'] = '0';
        $data['handled_at'] = '48';
        $data['upload_file'] = $data['upload_files'];
        $data['upload_file_path'] = 'uploads/grievance-management/documents/';
        $data['created_by'] = $request->user()->id;
        $data['status'] = 'open';
        $grievance = Grievance::create($data);
        GrievanceLog::create([
            'nhidcl_gms_grievance_application_id' => $grievance->id,
            'ref_users_id' => $request->user()->id,
            'action' => 'created',
            'comment' => $data['message'],
            'created_by' => $request->user()->id,
        ]);

        // auto-assign to reporting manager
        $manager = $request->user()->reporting_manager_id ? User::find($request->user()->reporting_manager_id) : null;
        if ($manager) {
            $grievance->update(['ref_assign_users_id' => $manager->id]);
            try {
                $manager->notify(new GrievanceAssigned($grievance));
            } catch (\Exception $e) {
                Log::error("Notification failed: " . $e->getMessage());
            }

            GrievanceLog::create([
                'nhidcl_gms_grievance_application_id' => $grievance->id,
                'ref_users_id' => $manager->id,
                'action' => 'assigned',
                'comment' => 'Auto-assigned to reporting manager',
                'created_by' => $manager->id,
            ]);
        }
        return redirect()->route('grievance-management.grievance.index')->with('success', 'Grievance submitted successfully.');
    }

    public function show(Grievance $grievance)
    {
        $this->authorize('view', $grievance);
        return view('grievance-management.show', compact('grievance'));
    }

    public function viewDetails($id){
        $id = Crypt::decrypt($id);
        $grievance = Grievance::with('assigned','logs', 'logs.user')->find($id);
        $header = true;
        $sidebar = true;
        return view('grievance-management.details', compact('header', 'sidebar', 'grievance'));
    }

    public function addComment(Request $request, Grievance $grievance)
    {
        //$this->authorize('update', $grievance);
        $data = $request->validate(['comment' => 'required|string', 'status' => 'required|string']);
        $grievance->status = $data['status'];
        $grievance->save();

        GrievanceLog::create([
            'nhidcl_gms_grievance_application_id' => $grievance->id,
            'ref_users_id' => $request->user()->id,
            'action' => 'comment',
            'comment' => $data['comment'],
            'created_by' => $request->user()->id,
        ]);
        return redirect()->route('grievance-management.grievance.details', Crypt::encrypt($grievance->id))->with('success', 'Comment added.');
    }

    public function changeStatus(Request $request, Grievance $grievance)
    {
        $this->authorize('update', $grievance);
        $data = $request->validate(['status' => 'required|in:open,under_review,resolved,closed,rejected']);
        $grievance->update([
            'status' => $data['status'],
            'handled_at' => now()
        ]);
        GrievanceLog::create([
            'nhidcl_gms_grievance_application_id' => $grievance->id,
            'ref_users_id' => $request->user()->id,
            'action' => 'status_changed',
            'comment' => $data['status'],
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('grievance-management.grievance.index')->with('success', 'Status updated.');
    }

    public function downloadAttachment(Grievance $grievance)
    {
        $this->authorize('view', $grievance);
        if (!$grievance->attachment) abort(404);
        return Storage::disk('private')->download($grievance->attachment);
    }

    public function edit($id){
        
    }

    public function update(Request $request){
        
    }

    public function destroy($id){
        
    }

    public function storeFeedback(Request $request, $id)
    {
        $grievance = Grievance::findOrFail($id);

        $request->validate([
            'feedback_status' => 'required|in:satisfied,not_satisfied',
            'feedback_remarks' => 'nullable|string|max:1000',
        ]);

        $grievance->feedback_status = $request->feedback_status;
        $grievance->feedback_remarks = $request->feedback_remarks;
        $grievance->save();

        // If employee is not satisfied → reopen or escalate
        if ($request->feedback_status == 'not_satisfied') {
            $grievance->status = 'appealed'; // new status
            $grievance->escalation_level = 2; // force to MD/top authority
            $grievance->ref_assign_users_id = User::role('General Manager')->first()->id;
            $grievance->save();

            GrievanceLog::create([
                'nhidcl_gms_grievance_application_id' => $grievance->id,
                'ref_users_id' => auth()->id(),
                'action' => 'appealed',
                'comment' => $request->feedback_remarks,
                'created_by' => auth()->id(),
            ]);
        }

       return redirect()->route('grievance-management.grievance.index')->with('success', 'Your feedback has been recorded.');
    }


    public function storeFiles(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'doc'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_file')) {
                    return storeMedia($request, 'uploads/grievance-management/documents/', $ext, 'upload_file');
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
        } catch (Exception $e) {
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
            return redirect()->route('employee-management.dashboard')->with('error', 'File not found.');
        }
    }

    public function deleteFile(Request $request)
    {
        $fileName = $request->input('file_name');
        $pathName = $request->input('path_name'); // this must be passed from frontend
        $folderPath = viewFilePath($pathName); // Use same function as in viewFiles
        $fullPath = $folderPath . $fileName;
        if ($fileName && file_exists($fullPath)) {
            unlink($fullPath);
            return response()->json(['status' => true, 'message' => 'File deleted']);
        }
        return response()->json(['status' => false, 'message' => 'File not found']);
    }

}