<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefQualification;
use App\Models\RefBoardUniversityCollege;
use App\Models\RefPassingYear;

class NhidclEmployeeEducationDetails extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_education_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "ref_qualification_id",
        "college_name",
        "ref_board_university_college_id",
        "ref_passing_year_id",
        "marks_percentage",
        "marksheet_certificate",
        "marksheet_certificate_filepath",
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
    
    public function qualification(){
        return $this->belongsTo(RefQualification::class,"ref_qualification_id");
    }

    public function university(){
        return $this->belongsTo(RefBoardUniversityCollege::class,"ref_board_university_college_id");
    }

    public function passingyear(){
        return $this->belongsTo(RefPassingYear::class,"ref_passing_year_id");
    }

}