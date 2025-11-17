<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class NhidclEmployeeTrainingDetails extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_training_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "training_name",
        "start_date",
        "end_date",
        "summary",
        "certificate_expiry",
        "certificate",
        "certificate_filepath",
        "created_by",
        "updated_by",
        "deleted_at",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email', 'ref_department_id');
    }

}