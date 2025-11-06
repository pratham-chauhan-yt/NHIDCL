<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\DepartmentMaster;
use App\Models\RefStatus;
use App\Models\EmployeeManagement\NhidclAsset;
use App\Models\EmployeeManagement\NhidclLeave;
use App\Models\EmployeeManagement\NhidclAttendance;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class EmpDashboardController extends Controller
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

    public function dashboard()
    {   
        $header = true;
        $sidebar = true;
        return view("employee-management.home", compact("header", "sidebar"));
    }

    public function calendar()
    {   
        $header = true;
        $sidebar = true;
        return view("employee-management.calendar", compact("header", "sidebar"));
    }

    public function empAttendance(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $query = NhidclLeave::with(['user', 'checker', 'approver'])
                ->orderBy('id', 'desc');
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->user->name ?: 'N/A';
            })
            ->addColumn('division', function ($row) {
                return optional($row->user->department)->name ?? 'N/A';
            })
            ->addColumn('purpose', function ($row) {
                return $row->purpose_of_leave ?: 'N/A';
            })
            ->addColumn('address', function ($row) {
                return $row->address_during_leave_period ?: 'N/A';
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
            ->addColumn('checker', function ($row) {
                return $row->checker->name ?? 'N/A';
            })
            ->addColumn('checker_remark', function ($row) {
                return $row->checker_remark ?: 'N/A';
            })
            ->addColumn('approver', function ($row) {
                return $row->approver->name ?? 'N/A';
            })
            ->addColumn('approver_remark', function ($row) {
                return $row->approver_remark ?: 'N/A';
            })
            ->rawColumns(['status'])
            ->make(true);
        }
        return view("employee-management.attendance", compact("header", "sidebar"));
    }

    public function hrAttendanceTable(Request $request){
        if ($request->ajax()) {
            $query = NhidclAttendance::with(['user', 'checker', 'approver'])
                ->orderBy('id', 'desc');
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->user->name ?: 'N/A';
            })
            ->addColumn('division', function ($row) {
                return optional($row->user->department)->name ?? 'N/A';
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
    }

    public function assignAssets(Request $request){
        $header = true;
        $sidebar = true;
        $department = DepartmentMaster::orderBy('name', 'asc')->get();
        $users = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->whereNot('name', ['Resource Pool User', 'Super Admin']);
        })->get();
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclAsset::with('createdBy', 'user.department')
            ->where(column: function ($q) use ($userId) {
                    $q->where('created_by', $userId)
                    ->orWhereIn('created_by', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name_of_asset', function ($row) {
                    return $row->name_of_asset ?: 'N/A';
                })
                ->addColumn('total', function ($row) {
                    return $row->total_assets ?: null;
                })
                ->addColumn('alloted', function ($row) {
                    $from = $row->alloted_date ? Carbon::parse($row->alloted_date)->format('d-m-Y') : '';
                    $to = $row->returned_date ? Carbon::parse($row->returned_date)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
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
                ->addColumn('remark', function ($row) {
                    return $row->remark ?: null;
                })
                ->addColumn('users', function ($row) {
                    return $row->user?->name ?? 'N/A';
                })
                ->addColumn('department', function ($row) {
                    return $row->user?->department?->name ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->ref_status_id == 10) {
                        return '';
                    }
                    $id = Crypt::encrypt($row->id);
                    $editUrl = route('employee-management.hr.assign.asset.edit', $id);
                    $deleteUrl = route('employee-management.hr.assign.asset.delete', $id);

                    $deleteButton = '';
                    if ($row->ref_status_id == 1) {
                        $deleteButton = '
                            <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        ';
                    }

                    return '
                        <div class="inline-flex">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                            ' . $deleteButton . '
                        </div>
                    ';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        if($request->method()=="POST"){
            try {
                // Define validation rules
                $validated = $request->validate([
                    'asset_name' => 'required|string|max:255', // Example validation rule
                    'number_of_asset' => 'required|integer|min:1',
                    'remarks' => 'required|string|max:500',
                    'division' => 'required|exists:ref_department,id', // Assume it must be a valid user ID from the 'users' table
                    'assign' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                ]);
                // Proceed with creating the leave record
                NhidclAsset::create([
                    'ref_users_id' => $validated['assign'],
                    'name_of_asset' => $validated['asset_name'],
                    'total_assets' => $validated['number_of_asset'],
                    'remark' => $validated['remarks'],
                    'ref_department_id' => $validated['division'],
                    'ref_status_id' => '1',
                    'alloted_date' => now(),
                    'created_by' => user()->id,
                    'created_at' => now()
                ]);
                Alert::success('Success', 'Asset assigned to employee successfully');
                return redirect()->route("employee-management.hr.assign.asset");
            } catch (Exception $e) {
                return redirect()->route("employee-management.hr.assign.asset")->with("error", $e->getMessage());
            }
        }
        return view("employee-management.assign-asset", compact("header", "sidebar", "users", "department"));
    }

    public function assignAssetsEdit($id, Request $request)
    {   
        $header = true;
        $sidebar = true;
        try {
            $decryptedId = Crypt::decrypt($id);
            $assignasset = NhidclAsset::findOrFail($decryptedId);
            
            $department = DepartmentMaster::orderBy('name', 'asc')->get();
            $status = RefStatus::whereIn('type', ['Pending', 'Alloted', 'Returned'])->orderBy('id', 'asc')->get();
            $users = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
                $query->whereNot('name', ['Resource Pool User', 'Super Admin']);
            })->where('ref_department_id', $assignasset->ref_department_id)->get();
            if($request->method()=="POST"){
                try {
                    // Define validation rules
                    $validated = $request->validate([
                        'name_of_asset' => 'required|string|max:255', // Example validation rule
                        'total_assets' => 'required|integer|min:1',
                        'ref_department_id' => 'required|exists:ref_department,id', // Assume it must be a valid user ID from the 'users' table
                        'ref_users_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                        'ref_status_id' => 'required|exists:ref_status,id', // Assume it must be a valid status ID from the 'status' table
                        'returned_date' => 'nullable|date',
                        'remark' => 'required|string|max:500',
                    ]);
                    $assignasset->update(array_merge(
                        $request->only([
                            'name_of_asset',
                            'total_assets',
                            'ref_department_id',
                            'ref_users_id',
                            'ref_status_id',
                            'returned_date',
                            'remark'
                        ]),
                        ['updated_by' => auth()->user()->id] // manually set updated_at
                    ));
                    Alert::success('Success', 'Asset assigned to employee updated successfully');
                    return redirect()->route("employee-management.hr.assign.asset");
                } catch (Exception $e) {
                    return redirect()->route("employee-management.hr.assign.asset")->with("error", $e->getMessage());
                }
            }
            return view("employee-management.assign-asset-edit", compact("header", "sidebar", "users", "department", "assignasset", "status"));
        }catch (Exception $e) {
            return redirect()->route("employee-management.hr.assign.asset")->with("error", $e->getMessage());
        }
    }

    public function assignAssetsDelete($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclAsset::findOrFail($decryptedId);
            // Delete or your logic here
            $attendance->delete();
            Alert::success('Success', 'Asset deleted successfully');
            return redirect()->route("employee-management.hr.assign.asset")->with('success', 'Asset deleted successfully!');
        } catch (\Exception $e) {
            Alert::error('Ohho', 'Invalid or expired ID');

            return redirect()->route("employee-management.hr.assign.asset")->with('error', 'Invalid or expired ID!');
        }
    }


    public function getUsersByDivision(Request $request)
    {
        $divisionId = $request->division_id;
        $users = User::where('ref_department_id', $divisionId)->get(['id', 'name', 'email']);
        return response()->json(['users' => $users]);
    }

    public function assignAssetsTable(Request $request){
        if ($request->ajax()) {
            $query = NhidclAsset::with('createdBy')
            ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name_of_asset', function ($row) {
                    return $row->name_of_asset ?: 'N/A';
                })
                ->addColumn('total', function ($row) {
                    return $row->total_assets ?: null;
                })
                ->addColumn('alloted', function ($row) {
                    $from = $row->alloted_date ? Carbon::parse($row->alloted_date)->format('d-m-Y') : '';
                    $to = $row->returned_date ? Carbon::parse($row->returned_date)->format('d-m-Y') : '';
                    return $from . ' - ' . $to;
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
                ->addColumn('remark', function ($row) {
                    return $row->remark ?: null;
                })
                ->addColumn('users', function ($row) {
                    return $row->user?->name ?? 'N/A';
                })
                ->addColumn('department', function ($row) {
                    return $row->user?->department?->name ?? 'N/A';
                })
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy?->name ?? 'N/A';
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function storeFiles(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('payment_proof_file')) {
                    return storeMedia($request, 'uploads/employee-management/payment/', $ext, 'payment_proof_file');
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