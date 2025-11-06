<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclLeave;
use App\Models\EmployeeManagement\NhidclHrPolicies;
use App\Models\DepartmentMaster;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Carbon\Carbon;


class FacilitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
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
                ->rawColumns(['status'])
                ->make(true);
        }
        return view("employee-management.facilities.index", compact("header", "sidebar", "manager", "gmanager"));
    }

    public function store(Request $request){
        try {
            // Define validation rules
            $validated = $request->validate([
                'purpose' => 'required|string|max:255', // Example validation rule
                'address' => 'required|string|max:500',
                'from_date' => 'required|date|before_or_equal:to_date', // Date must be before or equal to 'to_date'
                'to_date' => 'required|date|after_or_equal:from_date', // Date must be after or equal to 'from_date'
                'prefix_from_date' => 'required|date|before_or_equal:prefix_to_date', // Date must be before or equal to 'to_date'
                'prefix_to_date' => 'required|date|after_or_equal:prefix_from_date', // Date must be after or equal to 'from_date'
                'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            ]);
            $totalDays = Carbon::parse($validated['from_date'])->diffInDays(Carbon::parse($validated['to_date'])) + 1;
            // Proceed with creating the leave record
            NhidclLeave::create([
                'ref_users_id' => user_id(),
                'purpose_of_leave' => $validated['purpose'],
                'address_during_leave_period' => $validated['address'],
                'from_date' => $validated['from_date'],
                'to_date' => $validated['to_date'],
                'prefix_from' => $validated['prefix_from_date'],
                'prefix_to' => $validated['prefix_to_date'],
                'ref_checker_id' => $validated['ref_checker_id'],
                'ref_approver_id' => $validated['ref_approver_id'],
                'total_days' => $totalDays,
                'ref_status_id' => '1',
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'Leave applied successfully');
            return redirect()->route("employee-management.other.facilities.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.other.facilities.index")->with("error", $e->getMessage());
        }
    }

    public function hrPolicies(Request $request){
        $header = true;
        $sidebar = true;
        $department = DepartmentMaster::orderBy('name', 'asc')->get();
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            // $query = NhidclHrPolicies::where(function ($q) use ($userId) {
            //         $q->where('created_by', $userId)
            //         ->orWhereIn('created_by', [$userId]); // or even $adminIds if intended
            //     })
            //     ->orderBy('id', 'desc');
            $query = NhidclHrPolicies::with('department')->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title ?: 'N/A';
                })
                ->addColumn('department', function ($row) {
                    return optional($row->department)->name ?: 'N/A';
                })
                ->addColumn('policy_date', function ($row) {
                    return $row->policy_date ? Carbon::parse($row->policy_date)->format('d-m-Y') : null;
                })
                ->addColumn('users', function ($row) {
                    return $row->user->name ." (".$row->user->email.")" ?: 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $buttons = '';
                    $deleteUrl = route('employee-management.hr.policies.delete', Crypt::encrypt($row->id));
                    if ($row->policy_file) {
                        $buttons .= '<a href="' . route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->policy_file
                        ]) . '" target="_blank" class="btn btn-default btn-sm">View</a> ';
                    } else {
                        $buttons .= '';
                    }
                    
                    // Delete button
                    $buttons .= '
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger me-1">
                                Delete
                            </button>
                        </form>';
                    return $buttons;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view("employee-management.facilities.hr-policy", compact("header", "sidebar", "department"));
    }

    public function hrPoliciesStore(Request $request){

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255', // Example validation rule
                'ref_department_id' => 'required',
                'date' => 'required',
                'policy_file' => 'required',
            ]);
            // Proceed with creating the record
            NhidclHrPolicies::create([
                'title' => $validated['title'],
                'ref_department_id' => $validated['ref_department_id'],
                'policy_date' => $validated['date'],
                'policy_file' => $validated['policy_file'],
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'New HR policy created successfully');
            return redirect()->route("employee-management.hr.policies");
        } catch (Exception $e) {
            return redirect()->route("employee-management.hr.policies")->with("error", $e->getMessage());
        }
    }

    public function deletePolicy($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclHrPolicies::findOrFail($decryptedId);
            $attendance->delete();
            Alert::success('Success', 'Policy deleted successfully.');
            return redirect()->route('employee-management.hr.policies')->with('success', 'Policy deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()->route('employee-management.hr.policies')->with('error', 'Invalid ID or record not found.');
        }
    }
}