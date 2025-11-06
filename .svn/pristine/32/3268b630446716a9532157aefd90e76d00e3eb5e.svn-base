<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;

class NhidclExitInterview extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_resignation_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "reason",
        "notice_period_days",
        "ref_checker_id",
        "ref_approver_id",
        "checker_remark",
        "approver_remark",
        "resignation_date",
        "last_working_day",
        "ref_status_id",
        "updated_by",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email', 'ref_department_id');
    }

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }
}