<?php 

namespace App\Http\Controllers\TrainingManagement;

use App\Http\Controllers\Controller;
use App\Models\TrainingManagement\TrainingRequest;
use App\Models\{RefStatus,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\UserNotification;

class TrainingRequestController extends Controller
{   
    public function index(Request $request)
    {   
        $header = true;
        $sidebar = true;
        $userId = auth()->user()->id; 
        // Check for AJAX request
        if ($request->ajax()) {
            $query = TrainingRequest::with('user')->latest();
            if (auth()->user()->hasRole('Employee')) {
                $query->where('ref_users_id', $userId);
            }
            $getData = $query->get();

            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Conditionally render buttons based on user role
                    $editUrl = route('training.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('training.destroy', Crypt::encrypt($row->id));
                    if (auth()->user()->hasRole('Employee')) {
                        return '
                        <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</button>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    } else {
                        if(empty($row->hr_message)){
                            return "<button class='btn btn-info btn-sm' onclick='openApproveModal(\"" . Crypt::encrypt($row->id) . "\")'>Approve</button>";
                        }else{
                            return "<button class='btn btn-success btn-sm'>Approved</button>";
                        }
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
        return view('training-management.training_requests.index', compact('header', 'sidebar', 'status'));
    }

    public function create()
    {   
        $header = true;
        $sidebar = true;
        return view('training-management.training_requests.create', compact('header', 'sidebar'));
    }

    // Attendee submits request
    public function store(Request $request)
    {   
        $request->validate([
            'training_topic' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);
        $statusId = RefStatus::where('type', 'Pending')->where('status_type', 'training budget')->value('id');
        $request = TrainingRequest::create([
            'ref_users_id' => auth()->id(),
            'training_topic' => $request->training_topic,
            'message' => $request->message,
            'ref_status_id' => $statusId,
            'created_by' => auth()->id(),
        ]);

        // Create notifcation for trainers
        $assignedUser = User::role('HR')->first();
        if ($assignedUser) {
            $message = $request->training_topic . ' training request has been assigned for approval.';
            $link = route('hr.training.requests');
            $assignedUser->notify(new UserNotification($message, $link));
        }

        Alert::success('Success', 'Training request submitted to HR Admin.');
        return redirect()->route('training.index')->with('success', 'Training request submitted to HR Admin.');
    }

    public function edit($id){
        $header = true;
        $sidebar = true;
        $requestData = TrainingRequest::findOrFail(Crypt::decrypt($id));
        return view('training-management.training_requests.edit', compact('header', 'sidebar', 'requestData'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'training_topic' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);
        $requestData = TrainingRequest::findOrFail(Crypt::decrypt($id));
        $requestData->training_topic = $request->training_topic;
        $requestData->message = $request->message;
        $requestData->updated_by = auth()->user()->id;
        $requestData->save();
        Alert::success('Success', 'Training request updated successfully.');
        return redirect()->route('training.index')->with('success', 'Training request updated successfully.');
    }

    public function destroy(string $id)
    {
        try {
            $request = TrainingRequest::find(decryptId($id));
            if (!$request) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('training.index')->with('error', 'Something went wrong, Please try again.');
            }
            $request->is_deleted = true;
            $request->delete();
            Alert::success('Success', 'Training request deleted successfully');
            return redirect()->route('training.index')->with('success', 'Training request deleted successfully.');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('training.index')->with('error', 'Something went wrong, Please try again.');
        }
    }

    // HR: approve/reject request
    public function requestApprove(Request $request)
    {   
        $request->validate([
            'hr_message' => 'required|string|max:500',
            'ref_status_id' => 'required',
        ]);
        $requestId = Crypt::decrypt($request->approve_session_id);
        $requestData = TrainingRequest::findOrFail($requestId);
        $requestData->update(['ref_status_id' => $request->ref_status_id, 'hr_message' => $request->hr_message]);

        // (Optional: notify user)
        Alert::success('Success', 'Training request updated successfully');
        return redirect()->route('training.index')->with('success', 'Training request approved successfully.');
    }
}
