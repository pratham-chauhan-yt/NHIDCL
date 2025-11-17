<?php 

namespace App\Http\Controllers\TrainingManagement;

use App\Models\TrainingManagement\TrainingSession;
use App\Models\TrainingManagement\Trainer;
use App\Models\TrainingManagement\TrainingMaterial;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RefStatus;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\UserNotification;

class TrainingSessionController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        
        // Check for AJAX request
        if ($request->ajax()) {
            $query = TrainingSession::with(['trainer', 'attendees', 'status'])
                ->latest(); // Start with the latest ordering

            // Apply user-specific filters based on role
            if (auth()->user()->hasRole('HR')) {
                // If HR, fetch sessions created by the user
                $query->where('created_by', $userId);
            } else {
                // If not HR, fetch sessions where the user is the assigned trainer
                $trainerId = Trainer::where('ref_users_id', $userId)->value('id') ?? 0;
                $query->where('nhidcl_ems_trainers_id', $trainerId);
            }

            $getData = $query->get();

            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Conditionally render buttons based on user role
                    $deleteUrl = route('sessions.destroy', Crypt::encrypt($row->id));
                    if (auth()->user()->hasRole('HR')) {
                        return '
                        <button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    } else {
                        return "<button class='btn btn-info btn-sm' onclick='openGuideModal(\"" . Crypt::encrypt($row->id) . "\")'>Materials</button>
                        <button class='btn btn-primary btn-sm' onclick='openBudgetModal(\"" . Crypt::encrypt($row->id) . "\")'>Budget</button>";
                    }
                })
                ->editColumn('type', function ($row) {
                    return ucwords($row->type);
                })
                ->editColumn('status', function ($row) {
                    return $row?->status->type ?? 'Scheduled';
                })
                ->editColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Return the initial view for HR and Trainer roles
        $header = TRUE;
        $sidebar = TRUE;
        $status   = RefStatus::where('status_type', 'training budget')->get();
        return view('training-management.trainer.sessions.index', compact('header', 'sidebar', 'status'));
    }


    public function create()
    {
        $trainers = Trainer::with('user')->get();
        $status   = RefStatus::where('status_type', 'training sessions')->get();
        $header = TRUE;
        $sidebar = TRUE;
        return view('training-management.trainer.sessions.create', compact('header', 'sidebar', 'trainers', 'status'));
    }

    public function store(Request $request)
    {   
        $userId = auth()->id();
        $request->validate([
            'trainer' => 'required|exists:ref_users,id',
            'name' => 'required|string|max:255',
            'agenda' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'duration' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'status' => 'required|exists:ref_status,id',
        ]);

        // Map incoming request data to the database field names
        $mappedData = [
            'nhidcl_ems_trainers_id' => $request->trainer,  // Assuming 'trainer_id' is the actual field name in your DB
            'name' => $request->name,    // Assuming 'session_name' is the actual field name
            'agenda' => $request->agenda,
            'address' => $request->address,
            'date' => $request->date,
            'duration' => $request->duration,
            'type' => $request->type,
            'ref_status_id' => $request->status,
            'created_by' => $userId   // Assuming 'status_id' is the actual field name
        ];

        // Create the new TrainingSession record with the mapped data
        $tsession = TrainingSession::create($mappedData);

        // Create notifcation for trainers
        $trainer = Trainer::find($request->trainer);
        $assignedUser = User::find($trainer->ref_users_id); // send to assigned officer
        if ($assignedUser) {
            $message = $tsession->name . ' training session has been assigned.';
            $sessionId = $tsession->id;
            $encryptedId = Crypt::encrypt($sessionId);
            $link = route('sessions.show', $encryptedId);

            $assignedUser->notify(new UserNotification($message, $link));
        }
        
        Alert::success('Success', 'Training session created successfully.');
        return redirect()->route('sessions.index')->with('success', 'Training session created successfully.');
    }

    public function show($id)
    {   
        $header = true;
        $sidebar = true;
        $id = Crypt::decrypt($id);
        $session = TrainingSession::find($id);
        $session->load(['trainer', 'attendees']);
        return view('training-management.trainer.sessions.show', compact('session', 'header', 'sidebar'));
    }

    public function edit(TrainingSession $session)
    {
        $trainers = User::role('Trainer')->get();
        return view('trainer.sessions.edit', compact('session', 'trainers'));
    }

    public function update(Request $request, TrainingSession $session)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
        ]);

        $session->update($request->all());

        return redirect()->route('sessions.index')->with('success', 'Training session updated successfully.');
    }

    public function uploadMaterial(Request $request){
        
        $id = Crypt::decrypt($request->session_id);
        $sessions = TrainingSession::find($id);
        $userId = auth()->id();
        $request->validate([
            'upload_file_txt' => 'required|string|max:255',
        ]);
        if(!empty($request->upload_file_txt)){
            $filedata = extractFileDetails($request->upload_file_txt);
            $dataArr['upload_file'] = @$filedata["fileName"];
            $dataArr['upload_filepath'] = @$filedata["filePath"];
        }
        $dataArr['nhidcl_ems_training_sessions_id'] = $sessions->id;
        $dataArr['ref_users_id'] = $userId;
        $dataArr['ref_users_id_approver'] = $sessions->created_by;
        $dataArr['created_by'] = $userId;
        
        // Create the new TrainingMaterial record with the data
        TrainingMaterial::create($dataArr);

        // Create notifcation for trainers
        $assignedUser = User::find($sessions->created_by); // send to assigned officer
        if ($assignedUser) {
            $message = $sessions->name . ' training session material created and assign for your approval.';
            $link = "";
            $assignedUser->notify(new UserNotification($message, $link));
        }

        Alert::success('Success', 'Training material created successfully.');
        return redirect()->route('sessions.index')->with('success', 'Training material created successfully.');
        
    }

    public function destroy($encryptedId)
    {   
        try {
            // Decrypt the ID
            $id = Crypt::decrypt($encryptedId);

            // Find the session and delete it
            $session = TrainingSession::findOrFail($id);
            $session->delete();
            Alert::success('Success', 'Training session deleted successfully.');
            return redirect()->route('sessions.index')->with('success', 'Training session deleted successfully.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails
            Alert::error('Error', 'Invalid session ID.');
            return redirect()->route('sessions.index')->with('error', 'Invalid session ID.');
        }
    }
}
