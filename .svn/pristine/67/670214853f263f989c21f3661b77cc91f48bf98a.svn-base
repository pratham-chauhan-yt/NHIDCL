<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclLeave;
use App\Models\TaskManagement\ModuleActivity;
use App\Models\User;
use App\Models\RefStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Carbon\Carbon;


class LeaveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
        $this->middleware('permission:candidate-apply-leave')->only(['index']);
        $this->middleware('permission:candidate-apply-leave')->only(['create', 'store']);
        $this->middleware('permission:candidate-apply-leave')->only(['show', 'view']);
        $this->middleware('permission:candidate-apply-leave')->only(['edit', 'update']);
        $this->middleware(['module.permission:candidate-apply-leave'])->only(['destroy']);
        $this->middleware(['module.permission:candidate-apply-leave-approver'])->only(['approver']);
        $this->middleware(['module.permission:candidate-apply-leave-checker'])->only(['checker']);
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
            $query = NhidclLeave::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('purpose', function ($row) {
                    return $row->purpose_of_leave ?: 'N/A';
                })
                ->addColumn('address', function ($row) {
                    return $row->address_during_leave_period ?: 'N/A';
                })
                ->addColumn('checker', function ($row) {
                    return $row->checker->name ?? 'N/A';
                })
                ->addColumn('approver', function ($row) {
                    return $row->approver->name ?? 'N/A';
                })
                ->addColumn('no_of_days', function ($row) {
                    $from = Carbon::parse($row->from_date);
                    $to = Carbon::parse($row->to_date);
                    return $from->diffInDays($to) + 1; // inclusive of both days
                })
                ->addColumn('date_range', function ($row) {
                    $from = $row->from_date ? Carbon::parse($row->from_date)->format('d-m-Y') : '';
                    $to = $row->to_date ? Carbon::parse($row->to_date)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('prefix_date_range', function ($row) {
                    $from = $row->prefix_from ? Carbon::parse($row->prefix_from)->format('d-m-Y') : '';
                    $to = $row->prefix_to ? Carbon::parse($row->prefix_to)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('checker_remark', function ($row) {
                    return $row->checker_remark ?: 'N/A';
                })
                ->addColumn('approver_remark', function ($row) {
                    return $row->approver_remark ?: 'N/A';
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.apply.leave.edit', $id);
                    $deleteUrl = route('employee-management.apply.leave.destroy', $id);

                    return '
                    <div class="inline-flex">
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("employee-management.leave.index", compact("header", "sidebar", "manager", "gmanager"));
    }

    public function store(Request $request){
        try {
            // Define validation rules
            $validated = $request->validate([
                'purpose_of_leave' => 'required|string|max:255', // Example validation rule
                'address_during_leave_period' => 'required|string|max:500',
                'from_date' => 'required|date|before_or_equal:to_date', // Date must be before or equal to 'to_date'
                'to_date' => 'required|date|after_or_equal:from_date', // Date must be after or equal to 'from_date'
                'prefix_from' => 'required|date|before_or_equal:prefix_to', // Date must be before or equal to 'to_date'
                'prefix_to' => 'required|date|after_or_equal:prefix_from', // Date must be after or equal to 'from_date'
                'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            ]);
            $totalDays = Carbon::parse($validated['from_date'])->diffInDays(Carbon::parse($validated['to_date'])) + 1;
            // Proceed with creating the leave record
            NhidclLeave::create([
                'ref_users_id' => user_id(),
                'purpose_of_leave' => $validated['purpose_of_leave'],
                'address_during_leave_period' => $validated['address_during_leave_period'],
                'from_date' => $validated['from_date'],
                'to_date' => $validated['to_date'],
                'prefix_from' => $validated['prefix_from'],
                'prefix_to' => $validated['prefix_to'],
                'ref_checker_id' => $validated['ref_checker_id'],
                'ref_approver_id' => $validated['ref_approver_id'],
                'total_days' => $totalDays,
                'ref_status_id' => '1',
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'Leave applied successfully');
            return redirect()->route("employee-management.apply.leave.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.apply.leave.index")->with("error", $e->getMessage());
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
            $leaves = NhidclLeave::findOrFail($decryptedId);
            return view('employee-management.leave.edit', compact("leaves","header", "sidebar", "manager", "gmanager"));
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.apply.leave.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function update(Request $request, $id)
    {   
        $decryptedId = Crypt::decrypt($id);
        $leave = NhidclLeave::findOrFail($decryptedId);
        // Define validation rules
        $validated = $request->validate([
            'purpose_of_leave' => 'required|string|max:255', // Example validation rule
            'address_during_leave_period' => 'required|string|max:500',
            'from_date' => 'required|date|before_or_equal:to_date', // Date must be before or equal to 'to_date'
            'to_date' => 'required|date|after_or_equal:from_date', // Date must be after or equal to 'from_date'
            'prefix_from' => 'required|date|before_or_equal:prefix_to', // Date must be before or equal to 'to_date'
            'prefix_to' => 'required|date|after_or_equal:prefix_from', // Date must be after or equal to 'from_date'
            'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
        ]);
        
        $leave->update($request->only(['purpose_of_leave', 'address_during_leave_period', 'from_date', 'to_date', 'prefix_from', 'prefix_to', 'ref_checker_id', 'ref_approver_id'])); // Update fields accordingly
        Alert::success('Success', 'Apply leave updated successfully.');
        return redirect()->route('employee-management.apply.leave.index')->with('success', 'Apply leave updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclLeave::findOrFail($decryptedId);
            $attendance->delete();
            Alert::success('Success', 'Apply leave deleted successfully.');
            return redirect()
                ->route('employee-management.apply.leave.index')
                ->with('success', 'Apply leave deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.apply.leave.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function checker(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclLeave::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_checker_id', $userId)
                    ->orWhereIn('ref_checker_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('purpose', function ($row) {
                    return $row->purpose_of_leave ?: 'N/A';
                })
                ->addColumn('address', function ($row) {
                    return $row->address_during_leave_period ?: 'N/A';
                })
                ->addColumn('checker', function ($row) {
                    return $row->checker->name ?? 'N/A';
                })
                ->addColumn('approver', function ($row) {
                    return $row->approver->name ?? 'N/A';
                })
                ->addColumn('no_of_days', function ($row) {
                    $from = Carbon::parse($row->from_date);
                    $to = Carbon::parse($row->to_date);
                    return $from->diffInDays($to) + 1; // inclusive of both days
                })
                ->addColumn('date_range', function ($row) {
                    $from = $row->from_date ? Carbon::parse($row->from_date)->format('d-m-Y') : '';
                    $to = $row->to_date ? Carbon::parse($row->to_date)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('prefix_date_range', function ($row) {
                    $from = $row->prefix_from ? Carbon::parse($row->prefix_from)->format('d-m-Y') : '';
                    $to = $row->prefix_to ? Carbon::parse($row->prefix_to)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('checker_remark', function ($row) {
                    return $row->checker_remark ?: 'N/A';
                })
                ->addColumn('approver_remark', function ($row) {
                    return $row->approver_remark ?: 'N/A';
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    if ($row->ref_status_id == 2) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.apply.leave.checker.edit', $id);
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
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("employee-management.leave.checker", compact("header", "sidebar"));
    }

    public function approver(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclLeave::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_approver_id', $userId)
                    ->orWhereIn('ref_approver_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('purpose', function ($row) {
                    return $row->purpose_of_leave ?: 'N/A';
                })
                ->addColumn('address', function ($row) {
                    return $row->address_during_leave_period ?: 'N/A';
                })
                ->addColumn('checker', function ($row) {
                    return $row->checker->name ?? 'N/A';
                })
                ->addColumn('approver', function ($row) {
                    return $row->approver->name ?? 'N/A';
                })
                ->addColumn('no_of_days', function ($row) {
                    $from = Carbon::parse($row->from_date);
                    $to = Carbon::parse($row->to_date);
                    return $from->diffInDays($to) + 1; // inclusive of both days
                })
                ->addColumn('date_range', function ($row) {
                    $from = $row->from_date ? Carbon::parse($row->from_date)->format('d-m-Y') : '';
                    $to = $row->to_date ? Carbon::parse($row->to_date)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('prefix_date_range', function ($row) {
                    $from = $row->prefix_from ? Carbon::parse($row->prefix_from)->format('d-m-Y') : '';
                    $to = $row->prefix_to ? Carbon::parse($row->prefix_to)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
                })
                ->addColumn('checker_remark', function ($row) {
                    return $row->checker_remark ?: 'N/A';
                })
                ->addColumn('approver_remark', function ($row) {
                    return $row->approver_remark ?: 'N/A';
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    if ($row->ref_status_id == 3) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.apply.leave.approver.edit', $id);
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
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("employee-management.leave.approver", compact("header", "sidebar"));
    }

    public function approverUpdate($id, Request $request){
        $header = true;
        $sidebar = true;
        try {
            $decryptedId = Crypt::decrypt($id);
            $leaves = NhidclLeave::findOrFail($decryptedId);
            if($leaves->ref_checker_id == auth()->user()->id){
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
                    $leaves->update(array_merge(
                        $request->only([
                            'ref_status_id',
                            'checker_remark',
                            'approver_remark'
                        ]),
                        ['updated_by' => auth()->user()->id] // manually set updated_at
                    ));

                    ModuleActivity::create([
                        "module" => "Employee Management",
                        "ref_users_id" => $leaves->ref_users_id,
                        "description" => "Apply leave status ". $validated['action']." update and updated id " . $leaves->id,
                        "ip_address" => $request->ip(),
                        "event" => $validated['action'],
                        "created_by" => auth()->user()->id,
                    ]);

                    Alert::success('Success', 'Apply leave status update successfully');
                    if($validated['action']=="approved"){
                        return redirect()->route("employee-management.apply.leave.approver");
                    }
                    return redirect()->route("employee-management.apply.leave.checker");
                } catch (Exception $e) {
                    return redirect()->route("employee-management.apply.leave.approver")->with("error", $e->getMessage());
                }
            }
            return view("employee-management.leave.update-remarks", compact("header", "sidebar", "leaves", "status"));
        }catch (Exception $e) {
            return redirect()->route("employee-management.apply.leave.approver")->with("error", $e->getMessage());
        }
    }
}