<?php

namespace App\Policies;
use App\Models\Grievance;
use App\Models\User;

class GrievancePolicy
{
    public function view(User $user, Grievance $grievance)
    {
        if ($user->hasAnyRole(['Super Admin','HR','General Manager'])) return true;
        return $user->id === $grievance->ref_users_id || $user->id === $grievance->ref_assign_users_id;
    }

    public function update(User $user, Grievance $grievance)
    {
        if ($user->hasAnyRole(['Super Admin','HR','General Manager'])) return true;
        return $user->id === $grievance->ref_assign_users_id; // only handler can update or employee for certain actions
    }
}