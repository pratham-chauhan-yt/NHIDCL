<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreRoleInSession
{
    public function handle(Authenticated $event)
    {
        // Get the authenticated user
        $user = $event->user;

        // Fetch the role from the role_user table based on the user ID and parent_role_id
        $roleUser = DB::table('role_user')
           // ->where('parent_role_id', 3)
            ->where('ref_user_id', $user->id)
            ->first();

        // If a role is found, store the role_id in the session
        if ($roleUser) {
            Session::put('role_id', $roleUser->role_id);
        }
    }
}