<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DepartmentMaster;

class NhidclEmployeeOrganisationDetails extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_organisation_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "user_type",
        "official_email",
        "ref_employee_type_id",
        "date_of_joining",
        "ref_designation_id",
        "ref_department_id",
        "employee_id",
        "present_level",
        "probation_period",
        "confirmation_date",
        "ref_users_id_reporting_officer",
        "posting_location",
        "salary_slip",
        "salary_slip_filepath",
        "offer_letter",
        "offer_letter_filepath",
        "nda_agreement",
        "nda_agreement_filepath",
        "bg_verfication_report",
        "bg_verfication_report_filepath",
        "disciplinary_report",
        "disciplinary_report_filepath",
        "vigilance_report",
        "vigilance_report_filepath",
        "medical_report",
        "medical_report_filepath",
        "marriage_certificate",
        "marriage_certificate_filepath",
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

    public function department(){
        return $this->belongsTo(DepartmentMaster::class,"ref_department_id");
    }

}