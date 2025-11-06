<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefInterviewStatus extends Model
{
    use HasFactory;

    protected $table="ref_interview_status";
    
    protected $fillable=[
        'ref_users_id',
        'status',
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_status', 'ref_interview_status_id', 'ref_users_id')
    //                 ->withTimestamps();
    // }

    public function userStatuses()
    {
        return $this->hasMany(UserStatus::class, 'ref_interview_status_id', 'id');
    }
}
