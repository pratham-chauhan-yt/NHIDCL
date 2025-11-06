<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function allNotifications()
    {
        $header = true;
        $sidebar = true;
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications.all', compact('sidebar', 'header', 'notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        // Mark as read
        $notification->markAsRead();

        // Redirect to the notification's URL
        return redirect($notification->data['url'] ?? url()->previous());
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['status' => 'success', 'message' => 'All notifications marked as read.']);
    }
}
