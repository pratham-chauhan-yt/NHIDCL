<?php

namespace App\Http\Controllers\TrainingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingManagement\{TrainingSession,TrainingRequest,TrainingBudget};
use App\Models\User;

use Illuminate\Support\Facades\DB;

class TrainingHrController extends Controller
{
    public function index()
    {   
        $header = true;
        $sidebar = true;
        $pendingRequests = TrainingRequest::whereHas('status', function ($query) {
            $query->where('type', 'Pending'); // Replace 'status_name' with the actual column name in ref_status table
            $query->where('status_type', 'training budget');
        })->count();
        $pendingBudgets = TrainingBudget::whereHas('status', function ($query) {
            $query->where('type', 'Pending'); // Replace 'status_name' with the actual column name in ref_status table
            $query->where('status_type', 'training budget');
        })->count();
        $totalTrainers = User::role('Trainer')->count();
        $sessionsCount = TrainingSession::count();
        $recentRequests = TrainingRequest::with('user','status')
            ->latest()
            ->take(5)
            ->get();
        return view('training-management.hr.dashboard', compact('header', 'sidebar', 'sessionsCount', 'pendingRequests', 'pendingBudgets', 'totalTrainers', 'recentRequests'));
    }

    public function create()
    {
        $trainers = User::role('Trainer')->get();
        return view('admin.trainings.create', compact('trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'trainer_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
        ]);

        TrainingSession::create([
            'title' => $request->title,
            'trainer_id' => $request->trainer_id,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => 'upcoming',
        ]);

        return redirect()->route('admin.trainings')->with('success', 'Training session created successfully!');
    }

    public function viewAttendees($id)
    {
        $session = TrainingSession::with('attendees')->findOrFail($id);
        return view('admin.trainings.attendees', compact('session'));
    }

    public function markComplete(Request $request, $id)
    {
        $session = TrainingSession::findOrFail($id);

        $session->update(['status' => 'completed']);

        // Update attendee pivot table
        DB::table('training_attendees')
            ->where('training_session_id', $session->id)
            ->update(['status' => 'completed']);

        return back()->with('success', 'Training marked as completed!');
    }

    public function trainingRequests()
    {
        $requests = TrainingRequest::with('user')->latest()->get();
        return view('admin.training_requests.index', compact('requests'));
    }

    public function approveRequest($id)
    {
        $request = TrainingRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        return back()->with('success', 'Training request approved!');
    }

    public function rejectRequest($id)
    {
        $request = TrainingRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('error', 'Training request rejected.');
    }
}
