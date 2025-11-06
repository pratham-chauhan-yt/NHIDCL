<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Models\EmployeeManagement\NhidclClaimExpenses;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Carbon\Carbon;


class ClaimExpensesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'module.access:Employee Management']);
        $this->middleware('permission:exit-interview')->only(['index']);
        $this->middleware('permission:exit-interview')->only(['create', 'store']);
        $this->middleware('permission:exit-interview')->only(['show', 'view']);
        $this->middleware('permission:exit-interview')->only(['edit', 'update']);
        $this->middleware(['module.permission:exit-interview'])->only(['destroy']);
        $this->middleware(function ($request, $next) {
            session(['moduleName' => 'Employee Management System']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {   
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $userId = auth()->user()->id;
            $query = NhidclClaimExpenses::with(['status'])
                ->where(function ($q) use ($userId) {
                    $q->where('ref_users_id', $userId)
                    ->orWhereIn('ref_users_id', [$userId]); // or even $adminIds if intended
                })
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('purpose', function ($row) {
                    return $row->purpose ?: 'N/A';
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount ?: 'N/A';
                })
                ->addColumn('claim_date', function ($row) {
                    $from = $row->from_date ? Carbon::parse($row->from_date)->format('d-m-Y') : '';
                    $to = $row->to_date ? Carbon::parse($row->to_date)->format('d-m-Y') : '';
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
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $editUrl = route('employee-management.claim.expenses.edit', $id);
                    $deleteUrl = route('employee-management.claim.expenses.destroy', $id);

                    $viewFileUrl = $row->payment_proof
                        ? route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->payment_proof,
                        ])
                        : null;

                    $buttons = '<div class="inline-flex">';

                    // Show Edit/Delete only if status is 1
                    if ($row->ref_status_id == 1) {
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">Edit</a>';
                        $buttons .= '
                            <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="button" onclick="confirmDelete(' . $row->id . ')" class="btn btn-sm btn-danger me-1">
                                    Delete
                                </button>
                            </form>';
                    }

                    // Always show View if file exists
                    if ($viewFileUrl) {
                        $buttons .= '<a href="' . $viewFileUrl . '" target="_blank" class="btn btn-sm btn-default">View</a>';
                    }

                    $buttons .= '</div>';

                    return $buttons;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view("employee-management.claim-expenses.index", compact("header", "sidebar"));
    }

    public function store(Request $request){
        try {
            // Define validation rules
            $validated = $request->validate([
                'purpose' => 'required|string|max:255', // Example validation rule
                'amount' => 'required',
                'from_date' => 'required|date|before_or_equal:to_date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'payment_proof' => 'required',
                'description' => 'required|string|max:500',
            ]);
            // Proceed with creating the leave record
            NhidclClaimExpenses::create([
                'ref_users_id' => user_id(),
                'purpose' => $validated['purpose'],
                'amount' => $validated['amount'],
                'from_date' => $validated['from_date'],
                'to_date' => $validated['to_date'],
                'description' => $validated['description'],
                'payment_proof' => $validated['payment_proof'],
                'claim_date' => date('Y-m-d'),
                'ref_status_id' => '1',
                'created_by' => user_id(),
                'created_at' => now()
            ]);
            Alert::success('Success', 'Claim expenses created successfully');
            return redirect()->route("employee-management.claim.expenses.index");
        } catch (Exception $e) {
            return redirect()->route("employee-management.claim.expenses.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {   
        try {
            $header = true;
            $sidebar = true;
            $decryptedId = Crypt::decrypt($id);
            $expenses = NhidclClaimExpenses::findOrFail($decryptedId);
            return view('employee-management.claim-expenses.edit', compact("expenses","header", "sidebar"));
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.claim.expenses.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function update(Request $request, $id)
    {   
        $decryptedId = Crypt::decrypt($id);
        $interview = NhidclClaimExpenses::findOrFail($decryptedId);
        $validated = $request->validate([
            'purpose' => 'required|string|max:255', // Example validation rule
            'amount' => 'required',
            'from_date' => 'required|date|before_or_equal:to_date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'description' => 'required|string|max:500',
            'payment_proof' => 'required',
        ]);

        $description = strip_tags($validated['description']);
        $description = preg_replace('/[^A-Za-z0-9\s\.\,\-]/', '', $description);
        $validated['description'] = $description;
        $interview->update($validated);

        Alert::success('Success', 'Claim expenses updated successfully.');
        return redirect()->route('employee-management.claim.expenses.index')->with('success', 'Claim expenses updated successfully.');
    }


    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $attendance = NhidclClaimExpenses::findOrFail($decryptedId);
            $attendance->delete();
            Alert::success('Success', 'Claim expenses deleted successfully.');
            return redirect()
                ->route('employee-management.claim.expenses.index')
                ->with('success', 'Claim expenses deleted successfully.');
        } catch (Exception $e) {
            Alert::error('Sorry', 'Invalid ID or record not found.');
            return redirect()
                ->route('employee-management.claim.expenses.index')
                ->with('error', 'Invalid ID or record not found.');
        }
    }

    public function table(Request $request){
        if ($request->ajax()) {
            $query = NhidclClaimExpenses::with(['status'])
                ->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('purpose', function ($row) {
                    return $row->purpose ?: 'N/A';
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount ?: 'N/A';
                })
                ->addColumn('claim_date', function ($row) {
                    $from = $row->from_date ? Carbon::parse($row->from_date)->format('d-m-Y') : '';
                    $to = $row->to_date ? Carbon::parse($row->to_date)->format('d-m-Y') : '';
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
                ->addColumn('users', function ($row) {
                    return $row->user->name ." (".$row->user->email.")" ?: 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return $row->payment_proof
                    ? '<a href="' . route('employee-management.view.files', [
                            'pathName' => 'uploads/employee-management/payment/',
                            'fileName' => $row->payment_proof
                        ]) . '" target="_blank"><i class="fa fa-eye"></i></a>'
                    : 'N/A';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }
}