<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;

class NhidclLeave extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_applied_leave_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "purpose_of_leave",
        "address_during_leave_period",
        "from_date",
        "to_date",
        "prefix_from",
        "prefix_to",
        "ref_checker_id",
        "ref_approver_id",
        "total_days",
        "ref_status_id",
        "checker_remark",
        "approver_remark",
        "created_by",
        "updated_by",
        "is_deleted"
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email');
    }

    public function approver(){
        return $this->belongsTo(User::class,"ref_approver_id")->select('id', 'name', 'email');
    }

    public function checker(){
        return $this->belongsTo(User::class,"ref_checker_id")->select('id', 'name', 'email');
    }

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }
}