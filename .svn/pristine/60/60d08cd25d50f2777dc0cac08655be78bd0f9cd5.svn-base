<?php 

namespace App\Http\Controllers\TrainingManagement;

use App\Models\TrainingManagement\{TrainingSession,TrainingAttendee};
use App\Models\RefStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class TrainingEnrollmentController extends Controller
{   

    public function session(){
        $header = true;
        $sidebar = true;
        $session = TrainingSession::with('trainer.user', 'status')->whereHas('status', function ($query) {
            $query->where('type', 'Scheduled'); // Replace 'status_name' with the actual column name in ref_status table
            $query->where('status_type', 'training sessions');
        })->get();
        return view('training-management.employee.sessions', compact('header', 'sidebar', 'session'));
    }

    public function enrolledSession(){
        $header = true;
        $sidebar = true;
        $user = auth()->user();
        $session = TrainingAttendee::with('session', 'attendee', 'status')->where('ref_users_id', $user->id)->whereHas('status', function ($query) {
            $query->where('type', 'Enrolled'); // Replace 'status_name' with the actual column name in ref_status table
            $query->where('status_type', 'training sessions');
        })->get();
        return view('training-management.employee.enrolled', compact('header', 'sidebar', 'session'));
    }

    // Attendee enrolls in a training
    public function enroll(Request $request, $id)
    {   
        $user = auth()->user();
        $session = TrainingSession::find(Crypt::decrypt($id));
        if ($session->attendees()->where('ref_users_id', $user->id)->exists()) {
            Alert::info('Info', 'You are already enrolled in this session.');
            return redirect()->route('training.employee.sessions')->with('success', 'You are already enrolled in this session.');
        }
        // Get "enrolled" status id from ref_status table
        $statusId = RefStatus::where('type', 'Enrolled')->where('status_type', 'training sessions')->value('id');
        
        // Attach with ref_status_id
        $session->attendees()->attach($user->id, [
            'ref_status_id' => $statusId,
            'created_by' => $user->id
        ]);
        Alert::success('Success', 'Successfully enrolled in training session.');
        return redirect()->route('training.employee.enrolled')->with('success', 'Successfully enrolled in training session.');
    }

    // Attendee withdraws from training before it starts
    public function withdraw($id)
    {   
        $user = auth()->user();
        $enrollment = TrainingAttendee::find(Crypt::decrypt($id));
        $session = TrainingSession::find($enrollment->nhidcl_ems_training_sessions_id);
        
        if (!$enrollment) {
            Alert::info('Info', 'You are not enrolled in this session.');
            return redirect()->route('training.employee.enrolled')->with('error', 'You are not enrolled in this session.');
        }

        // Only allow withdrawal if training not started
        if (now()->gte($session->date)) {
            Alert::error('Error', 'Cannot withdraw after session has started.');
            return redirect()->route('training.employee.enrolled')->with('error', 'Cannot withdraw after session has started.');
        }

        $enrollment->delete();
        Alert::success('Success', 'You have withdrawn from this session.');
        return redirect()->route('training.employee.enrolled')->with('success', 'You have withdrawn from this session.');
    }
}
