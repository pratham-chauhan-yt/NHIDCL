<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;

class UserActivityController extends Controller
{
    public function logActivity($activity, $userId = null)
    {   
        $agent = new Agent();
        UserActivity::create([
            'ref_users_id' => $userId,
            'activity'     => is_string($activity) ? $activity : json_encode($activity),
            'ip_address'   => request()->ip(),
            'browser'    => $agent->browser(),
            'device'     => $agent->device(),
            'platform'   => $agent->platform(),
        ]);

        // Optional: log if unauthenticated user
        if (!$userId) {
            Log::warning('Unauthenticated activity logged.', [
                'ip'   => request()->ip(),
                'path' => request()->path(),
            ]);
        }
    }

    public function index()
    {
        $activities = UserActivity::where('ref_users_id', Auth::id())->latest()->get();
        return view('user.activities', compact('activities'));
    }

}