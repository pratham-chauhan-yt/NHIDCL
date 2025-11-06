<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table="nhidcl_user_status";
    
    protected $fillable=[
        'ref_users_id',
        'ref_interview_status_id',
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_status', 'ref_interview_status_id', 'ref_users_id')
    //                 ->withTimestamps();
    // }

    public function interviewStatus()
    {
        return $this->belongsTo(RefInterviewStatus::class, 'ref_interview_status_id', 'id');
    }

    // Define the relationship between UserStatus and User
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id', 'id');
    }

}
