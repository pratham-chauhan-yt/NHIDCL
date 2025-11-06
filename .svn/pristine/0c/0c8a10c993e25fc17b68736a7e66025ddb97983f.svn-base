<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DepartmentMaster;

class NhidclHrPolicies extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_hr_policies';
    protected $guarded = [];

    protected $fillable = [
        "title",
        "ref_department_id",
        "policy_date",
        "policy_file",
        "created_by",
        "is_deleted"
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,"created_by")->select('id', 'name', 'email');
    }

    public function department(){
        return $this->belongsTo(DepartmentMaster::class,"ref_department_id")->select('id', 'name');
    }
}