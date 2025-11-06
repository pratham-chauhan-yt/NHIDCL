<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;

class NhidclAsset extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_assign_asset';
    protected $guarded = [];

    protected $fillable = [
        
        "name_of_asset",
        "total_assets",
        "remark",
        "ref_department_id",
        "ref_users_id",
        "ref_status_id",
        "alloted_date",
        "returned_date",
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
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email', 'ref_department_id');
    }

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }
}