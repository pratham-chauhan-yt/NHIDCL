<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclAttendance;
use App\Models\TaskManagement\ModuleActivity;
use App\Models\User;
use App\Models\RefStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
        $this->middleware('permission:candidate-mark-attendance')->only(['index']);
        $this->middleware('permission:candidate-mark-attendance')->only(['create', 'store']);
        $this->middleware('permission:candidate-mark-attendance')->only(['show', 'view']);
        $this->middleware('permission:candidate-mark-attendance')->only(['edit', 'update']);
        $this->middleware(['module.permission:candidate-mark-attendance'])->only(['destroy']);
        $this->middleware(['module.permission:mark-attendance-approver'])->only(['approver']);
        $this->middleware(['module.permission:mark-attendance-checker'])->only(['checker']);
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
            $query = NhidclAttendance::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
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
                    if ($row->ref_status_id != 1) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id); // secure the ID
                    $editUrl = route('employee-management.mark.attendance.edit', $id);
                    $deleteUrl = route('employee-management.mark.attendance.destroy', $id);

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
        return view("employee-management.attendance.index", compact("header", "sidebar", "manager", "gmanager"));
    }
   public function reverseGeo(Request $request)
{
    $lat = $request->lat;
    $lon = $request->lon;

    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lon}";

    try {
        $response = Http::withHeaders([
            'User-Agent' => 'YourAppName/1.0'
        ])->withOptions([
            'verify' => false, // Disable SSL verification (local only)
        ])->get($url);

        return response()->json($response->json(), 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Server error fetching location',
            'message' => $e->getMessage(),
        ], 500);
    }
}


    public function store(Request $request){
        try {
            // Define validation rules
            $validated = $request->validate([
                'purpose' => [
                    'required',
                    'string',
                    'max:255',
                    'not_regex:/<[^>]*script[^>]*>/i', // Basic script tag detection
                ],
                'address' => [
                    'required',
                    'string',
                    'max:500',
                    'not_regex:/<[^>]*script[^>]*>/i' // Prevent script tags
                ],
                'from_date' => 'required|date|before_or_equal:to_date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'ref_checker_id' => 'required|exists:ref_users,id',
                'ref_approver_id' => 'required|exists:ref_users,id',
            ], [
                'purpose.not_regex' => 'Your input in the "Purpose" field contains unsafe characters. Please remove any HTML or scripts and try again.',
                'address.not_regex' => 'Your input in the "Address" field contains unsafe characters. Please remove any HTML or scripts and try again.',
            ]);

            $totalDays = Carbon::parse($validated['from_date'])->diffInDays(Carbon::parse($validated['to_date'])) + 1;
            // Proceed with creating the attendance record
            NhidclAttendance::create([
                'ref_users_id' => user_id(),
                'purpose' => $validated['purpose'],
                'address' => $validated['address'],
                'from_date' => $validated['from_date'],
                'to_date' => $validated['to_date'],
                'ref_checker_id' => $validated['ref_checker_id'],
                'ref_approver_id' => $validated['ref_approver_id'],
                'total_days' => $totalDays,
                'ref_status_id' => '1',
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'Attendance marked successfully');
            return redirect()->route("employee-management.mark.attendance.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.mark.attendance.index")->with("error", $e->getMessage());
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
            $attendance = NhidclAttendance::findOrFail($decryptedId);
            return view('employee-management.attendance.edit', compact("attendance","header", "sidebar", "manager", "gmanager"));
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.mark.attendance.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function update(Request $request, $id)
    {   
        $decryptedId = Crypt::decrypt($id);
        $attendance = NhidclAttendance::findOrFail($decryptedId);
        // Define validation rules
        $validated = $request->validate([
            'purpose' => [
                'required',
                'string',
                'max:255',
                'not_regex:/<[^>]*script[^>]*>/i', // Basic script tag detection
            ],
            'address' => [
                'required',
                'string',
                'max:500',
                'not_regex:/<[^>]*script[^>]*>/i' // Prevent script tags
            ],
            'from_date' => 'required|date|before_or_equal:to_date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'ref_checker_id' => 'required|exists:ref_users,id',
            'ref_approver_id' => 'required|exists:ref_users,id',
        ], [
            'purpose.not_regex' => 'Your input in the "Purpose" field contains unsafe characters. Please remove any HTML or scripts and try again.',
            'address.not_regex' => 'Your input in the "Address" field contains unsafe characters. Please remove any HTML or scripts and try again.',
        ]);
        $attendance->update($request->only(['purpose', 'address', 'from_date', 'to_date', 'ref_checker_id', 'ref_approver_id'])); // Update fields accordingly
        Alert::success('Success', 'Mark attendance updated successfully.');
        return redirect()->route('employee-management.mark.attendance.index')->with('success', 'Mark attendance updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclAttendance::findOrFail($decryptedId);
            $attendance->delete();
            Alert::success('Success', 'Mark Attendance deleted successfully.');
            return redirect()
                ->route('employee-management.mark.attendance.index')
                ->with('success', 'Mark Attendance deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.mark.attendance.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function checker(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclAttendance::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_checker_id', $userId)
                    ->orWhereIn('ref_checker_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
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
                    $editUrl = route('employee-management.mark.attendance.checker.edit', $id);
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
        return view("employee-management.attendance.checker", compact("header", "sidebar"));
    }

    public function approver(Request $request){
        $header = true;
        $sidebar = true;
        $userId = auth()->user()->id;
        if ($request->ajax()) {
            
            $query = NhidclAttendance::with(['checker', 'approver'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_approver_id', $userId)
                    ->orWhereIn('ref_approver_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
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
                    $editUrl = route('employee-management.mark.attendance.approver.edit', $id);
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
        return view("employee-management.attendance.approver", compact("header", "sidebar"));
    }

    public function approverUpdate($id, Request $request){
        $header = true;
        $sidebar = true;
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclAttendance::findOrFail($decryptedId);
            if($attendance->ref_checker_id == auth()->user()->id){
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
                    $attendance->update(array_merge(
                        $request->only([
                            'ref_status_id',
                            'checker_remark',
                            'approver_remark'
                        ]),
                        ['updated_by' => auth()->user()->id] // manually set updated_at
                    ));

                    ModuleActivity::create([
                        "module" => "Employee Management",
                        "ref_users_id" => $attendance->ref_users_id,
                        "description" => "Employee attendance status ". $validated['action']." update and updated id " . $attendance->id,
                        "ip_address" => $request->ip(),
                        "event" => $validated['action'],
                        "created_by" => auth()->user()->id,
                    ]);

                    Alert::success('Success', 'Employee attendance status update successfully');
                    if($validated['action']=="approved"){
                        return redirect()->route("employee-management.mark.attendance.approver");
                    }
                    return redirect()->route("employee-management.mark.attendance.checker");
                } catch (Exception $e) {
                    return redirect()->route("employee-management.mark.attendance.approver")->with("error", $e->getMessage());
                }
            }
            return view("employee-management.attendance.update-remarks", compact("header", "sidebar", "attendance", "status"));
        }catch (Exception $e) {
            return redirect()->route("employee-management.mark.attendance.approver")->with("error", $e->getMessage());
        }
    }

}