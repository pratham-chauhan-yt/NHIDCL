<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;

class UserNotificationController extends Controller
{
    public function notifyNewUser($creatorId, $userId)
    {
        $creator = User::findOrFail($creatorId);
        $user = User::findOrFail($userId);
        $message = "New user {$user->name} ($user->email) has been added by {$creator->name} ({$creator->email}).";

        $linkForother = route('user-config.show', Crypt::encrypt($user->id));
        $linkForUser = route('user-config.show', Crypt::encrypt($user->id));

        // Replace this with an array of actual super admin user IDs
        $superAdminIds = [1];

        Notification::send(User::whereIn('id', $superAdminIds)->get(), new UserNotification($message, $linkForother));
    }

    public function notifyProfileUpdated($userId, $subAdminId)
    {
        $user = User::findOrFail($userId);
        $subAdmin = User::findOrFail($subAdminId);

        $linkForSuperAdmin = route('user.profile', ['id' => $user->id]);
        $linkForUser = route('user.settings');

        // Notification for the user who updated their profile
        Notification::send([$user, $subAdmin], new UserNotification("You have updated your profile details successfully.", $linkForUser));

        // Notification for super admins
        $superAdminMessage = "{$user->name} has updated their details/profile.";
        $superAdminIds = [/* Array of super admin user IDs */];

        Notification::send(User::whereIn('id', $superAdminIds)->get(), new UserNotification("{$user->name} has updated their profile.", $linkForSuperAdmin));
    }

    public function notifyDestroyUser($creatorId, $userId)
    {
        $creator = User::findOrFail($creatorId);
        $user = User::findOrFail($userId);
        $message = "User {$user->name} ($user->email) has been deleted by {$creator->name} ({$creator->email}).";

        $link = route('user-config.show', Crypt::encrypt($user->id));

        // Replace this with an array of actual super admin user IDs
        $superAdminIds = [1];

        Notification::send(User::whereIn('id', $superAdminIds)->get(), new UserNotification($message, $link));
    }
}