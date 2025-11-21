<?php 

namespace App\Http\Controllers\TrainingManagement;

use App\Models\TrainingManagement\TrainingSession;
use App\Models\TrainingManagement\Trainer;
use App\Models\TrainingManagement\TrainingMaterial;
use App\Models\{User,DepartmentMaster,DesignationMaster};
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
                    $emplUrl = route('hr.trainer.sessions.employee', Crypt::encrypt($row->id));
                    $editUrl = route('sessions.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('sessions.destroy', Crypt::encrypt($row->id));
                    if (auth()->user()->hasRole('HR')) {
                        return '
                        <a href="'.$emplUrl.'" class="btn btn-info btn-sm">Participants</button>
                        <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</button>
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

    public function edit($id)
    {   
        $id = Crypt::decrypt($id);
        $header = true;
        $sidebar = true;
        $session = TrainingSession::find($id);
        $trainers = Trainer::with('user')->get();
        $status   = RefStatus::where('status_type', 'training sessions')->get();
        return view('training-management.trainer.sessions.edit', compact('header', 'sidebar', 'session', 'trainers', 'status'));
    }

    public function update(Request $request, $id)
    {   
        $id = Crypt::decrypt($id);
        $session = TrainingSession::find($id);
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
            'updated_by' => $userId   // Assuming 'status_id' is the actual field name
        ];

        $session->update($mappedData);
        Alert::success('Success', 'Training session updated successfully.');
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

    public function employee($encryptedId){
        try {
            // Decrypt the ID
            $id = Crypt::decrypt($encryptedId);
            $session = TrainingSession::findOrFail($id);
            $department = DepartmentMaster::get();
            $designation = DesignationMaster::get();
            $header = TRUE;
            $sidebar = TRUE;
            return view('training-management.trainer.sessions.employee', compact('header', 'sidebar', 'session', 'department', 'designation'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails
            Alert::error('Error', 'Invalid session ID.');
            return redirect()->route('sessions.index')->with('error', 'Invalid session ID.');
        }
    }

    public function sessionEmployee(Request $request){
        // If the request is an AJAX call for DataTables
        if ($request->ajax()) {
            $users = User::where('is_deleted', '!=', '1')
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', [
                    'Super Admin',
                    'Resource Pool User',
                    'Recruitment User'
                ]);
            })
            ->select([
                'id',
                'name',
                'email',
                'mobile',
                'ref_department_id',
                'ref_employee_type_id'
            ])
            ->with('roles'); // Eager loading roles to optimize queries
            
            if ($request->has('name') && $request->name != '') {
                $users->whereRaw('name ILIKE ?', ['%' . trim($request->name) . '%']);
            }
            if ($request->has('email') && $request->email != '') {
                $users->whereRaw('email ILIKE ?', ['%' . trim($request->email) . '%']);
            }
            if ($request->has('mobile') && $request->mobile != '') {
                $users->where('mobile', 'like', '%' . $request->mobile . '%');
            }
            if ($request->has('designation') && $request->designation != '') {
                $users->where('ref_designation_id', (int)$request->designation);
            }
            if ($request->has('department') && $request->department != '') {
                $users->where('ref_department_id', (int)$request->department);
            }

            $users = $users->orderBy('id', 'DESC')->get();
            
            return DataTables::of($users)
            ->setFilteredRecords($users->count())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $showUrl = route('user-config.show', Crypt::encrypt($row->id));
                $actionBtn = '<input type="checkbox" name="userid[]" value="'.$row->id.'">';
                return $actionBtn;
            })
            ->editColumn('department_master', function ($row) {
                return $row->department->name ?? 'NA';
                //return getDepartmentNameById($row->ref_department_id);
            })
            ->editColumn('roles', function ($row) {
                return $row->roles->pluck('name')->implode(', ');
            })
            ->editColumn('employee_type', function ($row) {
                return getEmployeeTypeNameById($row->ref_employee_type_id);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function sessionEmployeeRecord(Request $request){
        $user = $request->userid;
        $sessionId = Crypt::decrypt($request->sessionid);
        $session = TrainingSession::find($sessionId);
        foreach ($user as $userId) {
            $user = User::find($userId); // Find the user by ID
            if ($session->attendees()->where('ref_users_id', $user->id)->exists()) {
                Alert::info('Info', 'You are already enrolled in this session.');
                continue; // Skip this user if they are already enrolled
            }
            // Get "enrolled" status id from ref_status table
            $statusId = RefStatus::where('type', 'Enrolled')->where('status_type', 'training sessions')->value('id');
            
            // Attach with ref_status_id
            $session->attendees()->attach($user->id, [
                'ref_status_id' => $statusId,
                'created_by' => auth()->user()->id,
            ]);
        }
        Alert::success('Success', 'Candidate successfully enrolled in training session.');
        return redirect()->route('hr.trainer.sessions.employee', Crypt::encrypt($session->id))->with('success', 'Successfully enrolled in training session.');
    }
}
