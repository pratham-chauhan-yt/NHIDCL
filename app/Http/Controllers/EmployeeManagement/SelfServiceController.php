<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclSelfService;
use App\Models\User;
use App\Models\RefRequestType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Carbon\Carbon;


class SelfServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
    }

    public function index(Request $request)
    {   
        $header = true;
        $sidebar = true;
        $reqtype = RefRequestType::all();
        $manager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->where('name', 'Manager');
        })->get();
        $gmanager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->where('name', 'General Manager');
        })->get();
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclSelfService::with(['status'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('request_type', function ($row) {
                    return $row->request_type->request_type ?: 'N/A';
                })
                ->addColumn('request_details', function ($row) {
                    return $row->request_details ?: 'N/A';
                })
                ->addColumn('submission_date', function ($row) {
                    return $row->submission_date ? Carbon::parse($row->claim_date)->format('d-m-Y') : null;
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
                    $editUrl = route('employee-management.self.service.edit', $id);
                    $deleteUrl = route('employee-management.self.service.destroy', $id);
                    $viewFileUrl = $row->additional_documents
                        ? route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->additional_documents
                        ])
                        : null;
                    $buttons = '<div class="inline-flex">';
                    if ($viewFileUrl) {
                        $buttons .= '<a href="' . $viewFileUrl . '" target="_blank" class="btn btn-sm btn-default">View</a>';
                    }
                    $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">Edit</a>';
                    $buttons .= '
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger me-1">
                                Delete
                            </button>
                        </form>';
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view("employee-management.self-service.index", compact("header", "sidebar", "manager", "gmanager", "reqtype"));
    }

    public function store(Request $request){
        try {
            // Define validation rules
            $validated = $request->validate([
                'request_type' => 'required',
                'request_details' => 'required|string|max:500',
                'payment_proof' => 'required',
                'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
                'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            ]);
            NhidclSelfService::create([
                'ref_users_id' => user_id(),
                'ref_request_type_id' => $validated['request_type'],
                'request_details' => $validated['request_details'],
                'additional_documents' => $validated['payment_proof'],
                'ref_checker_id' => $validated['ref_checker_id'],
                'ref_approver_id' => $validated['ref_approver_id'],
                'submission_date' => date('Y-m-d'),
                'ref_status_id' => '1',
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'Employee self service created successfully');
            return redirect()->route("employee-management.self.service.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.self.service.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {   
        try {
            $header = true;
            $sidebar = true;
            $reqtype = RefRequestType::all();
            $manager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
                $query->where('name', 'Manager');
            })->get();
            $gmanager = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
                $query->where('name', 'General Manager');
            })->get();
            $decryptedId = Crypt::decrypt($id);
            $services = NhidclSelfService::findOrFail($decryptedId);
            return view('employee-management.self-service.edit', compact("services","header", "sidebar", "manager", "gmanager", "reqtype"));
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.self.service.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function update(Request $request, $id)
    {   
        $decryptedId = Crypt::decrypt($id);
        $services = NhidclSelfService::findOrFail($decryptedId);
        $validated = $request->validate([
            'request_type' => 'required',
            'request_details' => 'required|string|max:500',
            'payment_proof' => 'required',
            'ref_checker_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
            'ref_approver_id' => 'required|exists:ref_users,id', // Assume it must be a valid user ID from the 'users' table
        ]);

        $request_details = strip_tags($validated['request_details']);
        $request_details = preg_replace('/[^A-Za-z0-9\s\.\,\-]/', '', $request_details);
        $validated['request_details'] = $request_details;
        $services->update($validated);

        Alert::success('Success', 'Employee self service details updated successfully.');
        return redirect()->route('employee-management.self.service.index')->with('success', 'Employee self service details updated successfully.');
    }


    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $selfservice = NhidclSelfService::findOrFail($decryptedId);
            $selfservice->delete();
            Alert::success('Success', 'Employee self service records deleted successfully.');
            return redirect()
                ->route('employee-management.self.service.index')
                ->with('success', 'Employee self service records deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.self.service.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function table(Request $request){
        if ($request->ajax()) {
            $query = NhidclSelfService::with(['status'])
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('request_type', function ($row) {
                    return $row->request_type->request_type ?: 'N/A';
                })
                ->addColumn('request_details', function ($row) {
                    return $row->request_details ?: 'N/A';
                })
                ->addColumn('submission_date', function ($row) {
                    return $row->submission_date ? Carbon::parse($row->claim_date)->format('d-m-Y') : null;
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
                ->addColumn('users', function ($row) {
                    return $row->user->name ." (".$row->user->email.")" ?: 'N/A';
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
}