<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclExitInterview;
use App\Models\EmployeeManagement\NhidclAsset;
use App\Models\TaskManagement\ModuleActivity;
use App\Models\User;
use App\Models\RefStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Carbon\Carbon;


class ExitInterviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
        $this->middleware('permission:exit-interview')->only(['index']);
        $this->middleware('permission:exit-interview')->only(['create', 'store']);
        $this->middleware('permission:exit-interview')->only(['show', 'view']);
        $this->middleware('permission:exit-interview')->only(['edit', 'update']);
        $this->middleware(['module.permission:exit-interview'])->only(['destroy']);
        $this->middleware(['module.permission:exit-interview-approver'])->only(['approver']);
        $this->middleware(['module.permission:exit-interview-checker'])->only(['checker']);
        $this->middleware(function ($request, $next) {
            session(['moduleName' => 'Employee Management System']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {   
        $header = true;
        $sidebar = true;
        $manager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->where('name', 'Manager');
        })->get();
        $gmanager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->where('name', 'General Manager');
        })->get();
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclExitInterview::with(['status'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('reason', function ($row) {
                    return $row->reason ?: 'N/A';
                })
                ->addColumn('resign_date', function ($row) {
                    return $row->resignation_date ? Carbon::parse($row->resignation_date)->format('d-m-Y') : null;
                })
                ->addColumn('last_wdays', function ($row) {
                    return $row->last_working_day ? Carbon::parse($row->last_working_day)->format('d-m-Y') : null;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status->type; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize

                    // Optional: Style by status
                    $colorClass = match (strtolower($status)) {
                        'approved' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        'pending' => 'text-yellow-600',
                        default => 'text-gray-600',
                    };
                    return '<span class="interview ' . $colorClass . '">' . $label . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.exit.interview.edit', $id);
                    $deleteUrl = route('employee-management.exit.interview.destroy', $id);
                    $viewFileUrl = $row->additional_documents
                        ? route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->additional_documents
                        ])
                        : null;
                    $buttons = '<div class="inline-flex">';
                    $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">Edit</a>';
                    $buttons .= '
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger me-1">
                                Delete
                            </button>
                        </form>';
                    if ($viewFileUrl) {
                        $buttons .= '<a href="' . $viewFileUrl . '" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>';
                    }
                    $buttons .= '</div>';
                    return $buttons;
                })

                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view("employee-management.exit-interview.index", compact("header", "sidebar", "manager", "gmanager"));
    }

    public function store(Request $request){
        try {
            $noticePeriodDay = '90';
            $futureDate = Carbon::now()->addDays($noticePeriodDay);
            // Define validation rules
            $validated = $request->validate([
                'reason' => [
                    'required',
                    'string',
                    'max:500',
                    'not_regex:/<[^>]*script[^>]*>/i', // Basic script tag detection
                ],
                'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            ]);
            // Proceed with creating the leave record
            NhidclExitInterview::create([
                'ref_users_id' => user_id(),
                'reason' => $validated['reason'],
                'notice_period_days' => $noticePeriodDay,
                'ref_checker_id' => $validated['ref_checker_id'],
                'ref_approver_id' => $validated['ref_approver_id'],
                'resignation_date' => now(),
                'last_working_day' => $futureDate,
                'ref_status_id' => '1',
                'created_at' => now()
            ]);
            Alert::success('Success', 'Exit interview applied successfully');
            return redirect()->route("employee-management.exit.interview.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.exit.interview.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {   
        try {
            $header = true;
            $sidebar = true;
            $manager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
                $query->where('name', 'Manager');
            })->get();
            $gmanager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
                $query->where('name', 'General Manager');
            })->get();
            $decryptedId = Crypt::decrypt($id);
            $interview = NhidclExitInterview::findOrFail($decryptedId);
            return view('employee-management.exit-interview.edit', compact("interview","header", "sidebar", "manager", "gmanager"));
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.exit.interview.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $decryptedId = Crypt::decrypt($id);
        $interview = NhidclExitInterview::findOrFail($decryptedId);

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
            'ref_checker_id' => 'required|exists:ref_users,id',
            'ref_approver_id' => 'required|exists:ref_users,id',
        ]);

        $reason = strip_tags($validated['reason']);
        $reason = preg_replace('/[^A-Za-z0-9\s\.\,\-]/', '', $reason);
        $validated['reason'] = $reason;
        $interview->update($validated);

        Alert::success('Success', 'Exit interview updated successfully.');
        return redirect()->route('employee-management.exit.interview.index')->with('success', 'Exit interview updated successfully.');
    }


    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclExitInterview::findOrFail($decryptedId);
            $attendance->delete();
            Alert::success('Success', 'Exit interview deleted successfully.');
            return redirect()
                ->route('employee-management.exit.interview.index')
                ->with('success', 'Exit interview deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.exit.interview.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function table(Request $request)
    {   
        if ($request->ajax()) {
            $query = NhidclExitInterview::with(['status'])
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->name ?: 'N/A';
                })
                ->addColumn('division', function ($row) {
                    return optional($row->user->department)->name ?? 'N/A';
                })
                ->addColumn('reason', function ($row) {
                    return $row->reason ?: 'N/A';
                })
                ->addColumn('resign_date', function ($row) {
                    return $row->resignation_date ? Carbon::parse($row->resignation_date)->format('d-m-Y') : null;
                })
                ->addColumn('last_wdays', function ($row) {
                    return $row->last_working_day ? Carbon::parse($row->last_working_day)->format('d-m-Y') : null;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status->type; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize

                    // Optional: Style by status
                    $colorClass = match (strtolower($status)) {
                        'approved' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        'pending' => 'text-yellow-600',
                        default => 'text-gray-600',
                    };
                    return '<span class="interview ' . $colorClass . '">' . $label . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return $row->additional_documents
                    ? '<a href="' . route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->additional_documents
                        ]) . '" target="_blank"><i class="fa fa-eye"></i></a>'
                    : 'N/A';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }

    public function allotedAssetTable(Request $request){
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclAsset::with('createdBy')
            ->where(function ($q) use ($userId) {
                $q->where('ref_users_id', $userId)
                ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
            })
            ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name_of_asset', function ($row) {
                    return $row->name_of_asset ?: 'N/A';
                })
                ->addColumn('users', function ($row) {
                    return optional($row->user)->name ?? 'N/A';
                })
                ->addColumn('department', function ($row) {
                    return optional($row->user->department)->name ?? 'N/A';
                })
                ->addColumn('total', function ($row) {
                    return $row->total_assets ?: null;
                })
                ->addColumn('alloted', function ($row) {
                    return $row->alloted_date ? Carbon::parse($row->alloted_date)->format('d-m-Y') : null;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status->type; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize

                    // Optional: Style by status
                    $colorClass = match (strtolower($status)) {
                        'approved' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        'pending' => 'text-yellow-600',
                        default => 'text-gray-600',
                    };
                    return '<span class="interview ' . $colorClass . '">' . $label . '</span>';
                })
                ->addColumn('created_by', function ($row) {
                    return optional($row->created_by)->name ?? 'N/A';
                })
                ->addColumn('remark', function ($row) {
                    return $row->remark ?: null;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function checker(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclExitInterview::with(['status'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_checker_id', $userId)
                    ->orWhereIn('ref_checker_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('reason', function ($row) {
                    return $row->reason ?: 'N/A';
                })
                ->addColumn('resign_date', function ($row) {
                    return $row->resignation_date ? Carbon::parse($row->resignation_date)->format('d-m-Y') : null;
                })
                ->addColumn('last_wdays', function ($row) {
                    return $row->last_working_day ? Carbon::parse($row->last_working_day)->format('d-m-Y') : null;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status->type; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize

                    // Optional: Style by status
                    $colorClass = match (strtolower($status)) {
                        'approved' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        'pending' => 'text-yellow-600',
                        default => 'text-gray-600',
                    };
                    return '<span class="interview ' . $colorClass . '">' . $label . '</span>';
                })
                ->addColumn('action', function ($row) {
                    if ($row->ref_status_id == 2) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.exit.interview.checker.edit', $id);
                    $updateButton = '';
                    if ($row->ref_status_id == 1) {
                        $updateButton = '
                            <div class="inline-flex">
                                <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Update</a>
                            </div>
                        ';
                    }
                    return $updateButton;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view("employee-management.exit-interview.checker", compact("header", "sidebar"));
    }

    public function approver(Request $request){
        $header = true;
        $sidebar = true;
        $userId = auth()->user()->id;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclExitInterview::with(['status'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_approver_id', $userId)
                    ->orWhereIn('ref_approver_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('reason', function ($row) {
                    return $row->reason ?: 'N/A';
                })
                ->addColumn('resign_date', function ($row) {
                    return $row->resignation_date ? Carbon::parse($row->resignation_date)->format('d-m-Y') : null;
                })
                ->addColumn('last_wdays', function ($row) {
                    return $row->last_working_day ? Carbon::parse($row->last_working_day)->format('d-m-Y') : null;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status->type; // Adjust if your column name is different
                    $label = ucfirst($status); // Capitalize

                    // Optional: Style by status
                    $colorClass = match (strtolower($status)) {
                        'approved' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        'pending' => 'text-yellow-600',
                        default => 'text-gray-600',
                    };
                    return '<span class="interview ' . $colorClass . '">' . $label . '</span>';
                })
                ->addColumn('action', function ($row) {
                    if ($row->ref_status_id == 3) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.exit.interview.checker.edit', $id);
                    $updateButton = '';
                    if ($row->ref_status_id == 2) {
                        $updateButton = '
                            <div class="inline-flex">
                                <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Update</a>
                            </div>
                        ';
                    }
                    return $updateButton;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view("employee-management.exit-interview.approver", compact("header", "sidebar"));
    }

    public function approverUpdate($id, Request $request){
        $header = true;
        $sidebar = true;
        try {
            $decryptedId = Crypt::decrypt($id);
            $interview = NhidclExitInterview::findOrFail($decryptedId);
            if($interview->ref_checker_id == auth()->user()->id){
                $status = RefStatus::whereIn('type', ['Pending', 'Checked', 'Rejected'])->orderBy('id', 'asc')->get();
            }else{
                $status = RefStatus::whereIn('type', ['Pending', 'Checked', 'Approved', 'Rejected'])->orderBy('id', 'asc')->get();
            }           
            
            if($request->method()=="POST"){
                try {
                    $validated = $request->validate([
                        'ref_status_id' => 'required|exists:ref_status,id', // Assume it must be a valid status ID from the 'status' table
                        'checker_remark' => 'nullable|string|max:500',
                        'approver_remark' => 'nullable|string|max:500',
                        'action' => 'nullable',
                    ]);
                    $interview->update(array_merge(
                        $request->only([
                            'ref_status_id',
                            'checker_remark',
                            'approver_remark'
                        ]),
                        ['updated_by' => auth()->user()->id] // manually set updated_at
                    ));

                    ModuleActivity::create([
                        "module" => "Employee Management",
                        "ref_users_id" => $interview->ref_users_id,
                        "description" => "Exit interview status ". $validated['action']." update and updated id " . $interview->id,
                        "ip_address" => $request->ip(),
                        "event" => $validated['action'],
                        "created_by" => auth()->user()->id,
                    ]);

                    Alert::success('Success', 'Exit interview status update successfully');
                    if($validated['action']=="approved"){
                        return redirect()->route("employee-management.exit.interview.approver");
                    }
                    return redirect()->route("employee-management.exit.interview.checker");
                } catch (Exception $e) {
                    return redirect()->route("employee-management.exit.interview.approver")->with("error", $e->getMessage());
                }
            }
            return view("employee-management.exit-interview.update-remarks", compact("header", "sidebar", "interview", "status"));
        }catch (Exception $e) {
            return redirect()->route("employee-management.exit.interview.approver")->with("error", $e->getMessage());
        }
    }
}