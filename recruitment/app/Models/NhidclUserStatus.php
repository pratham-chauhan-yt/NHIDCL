<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclUserStatus extends Model
{
    use HasFactory;

    protected $table="nhidcl_user_status";
    
    protected $fillable=[
        'ref_users_id',
        'ref_interview_status_id',
        'nhidcl_resource_requisition_id',
    ];

}
