<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class NhidclEmployeeWorkExperienceDetails extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_work_experience_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "employer_name",
        "post_held",
        "from_date",
        "to_date",
        "job_summary",
        "experience_letter",
        "experience_letter_filepath",
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