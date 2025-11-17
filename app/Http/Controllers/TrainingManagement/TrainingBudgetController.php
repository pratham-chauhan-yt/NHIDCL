<?php 

namespace App\Http\Controllers\TrainingManagement;

use App\Models\TrainingManagement\{TrainingBudget,TrainingSession};
use Illuminate\Http\Request;
use App\Models\{RefStatus,User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\UserNotification;

class TrainingBudgetController extends Controller
{   

    public function index(Request $request){
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $query = TrainingBudget::with('trainer.user', 'session', 'status')->latest();
            $getData = $query->get();

            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('training', function ($row) {
                    return $row?->session->name ?? 'NA';
                })
                ->addColumn('trainer', function ($row) {
                    return $row?->trainer?->user?->name ?? 'NA';
                })
                ->addColumn('action', function ($row) {
                    // Conditionally render buttons based on user role
                    if(empty($row->approved_at)){
                        return "<button class='btn btn-info btn-sm' onclick='openApproveModal(\"" . Crypt::encrypt($row->id) . "\")'>Approve</button>";
                    }else{
                        return "<button class='btn btn-success btn-sm'>Approved</button>";
                    }
                    
                })
                ->editColumn('status', function ($row) {
                    return $row?->status->type ?? 'Pending';
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $status = RefStatus::where('status_type', 'training budget')->get();
        return view('training-management.training_budget.index', compact('header', 'sidebar', 'status'));
    }
    // Trainer submits budget
    public function store(Request $request)
    {   
        $encryptedSessionId = Crypt::decrypt($request->budget_session_id);
        $request->validate([
            'budget_session_id' => [
                'required',
                function ($attribute, $value, $fail) use ($encryptedSessionId) {
                    // Check if the encrypted ID exists in the database
                    if (!DB::table('nhidcl_ems_training_sessions')->where('id', $encryptedSessionId)->exists()) {
                        $fail('The selected budget session ID is invalid.');
                    }
                },
            ],
            'amount' => 'required|numeric|min:0',
            'ref_status_id' => 'required|exists:ref_status,id',
            'remarks' => 'required|max:255',
        ]);

        // Step 3: Proceed to create the TrainingBudget entry with the encrypted ID
        try {
            $sessions = TrainingSession::find($encryptedSessionId);
            TrainingBudget::create([
                'nhidcl_ems_training_sessions_id' => $sessions->id,  // Use the decrypted ID to store in the DB
                'nhidcl_ems_trainers_id' => $sessions->nhidcl_ems_trainers_id,  // Assuming you're using the authenticated trainer's ID
                'amount' => $request->amount,  // Amount from the request
                'ref_status_id' => $request->ref_status_id,  // Status field
                'remarks' => $request->remarks,  // Remarks field
                'created_by' => auth()->id(),
                'ref_users_id_approver' => $sessions->created_by,  // Assuming the approver is the logged-in user
            ]);

            // Create notifcation for trainers
            $assignedUser = User::find($sessions->created_by); // send to assigned officer
            if ($assignedUser) {
                $message = "Budget for $sessions->name training session assigned for approval.";
                $link = route('hr.training.budget');
                $assignedUser->notify(new UserNotification($message, $link));
            }

            Alert::success('Success', 'Training budget created successfully.');
            return redirect()->route('sessions.index')->with('success', 'Training budget created successfully.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Failed to create training budget: ' . $e->getMessage());
            Alert::error('Sorry', 'Failed to create training budget.');
            return redirect()->route('sessions.index')->with('success', 'Failed to create training budget.');
        }
    }

    // HR: Approve budget
    public function budgetApprove(Request $request)
    {   
        $budgetId = Crypt::decrypt($request->approve_session_id);
        $budget = TrainingBudget::findOrFail($budgetId);
        $budget->update(['ref_status_id' => $request->ref_status_id, 'approved_at' => date('Y-m-d h:i:s'), 'updated_by' => auth()->user()->id]);
        Alert::success('Success', 'Training budget approved successfully.');
        return redirect()->route('hr.training.budget')->with('success', 'Training budget approved successfully.');
    }

    // HR: Reject budget
    public function reject($id)
    {
        $budget = TrainingBudget::findOrFail($id);
        $budget->update(['status' => 'rejected']);
        return back()->with('info', 'Budget rejected.');
    }
}
