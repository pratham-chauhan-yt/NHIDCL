<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;
use App\Models\RefRequestType;

class NhidclSelfService extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_self_service_request';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "ref_request_type_id",
        "request_details",
        "additional_documents",
        "ref_checker_id",
        "ref_approver_id",
        "submission_date",
        "ref_status_id",
        "created_by",
        "updated_by",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email');
    }

    public function request_type(){
        return $this->belongsTo(RefRequestType::class,"ref_request_type_id")->select('id', 'request_type');
    }

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }
}