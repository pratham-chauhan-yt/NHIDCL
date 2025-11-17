<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;

class NhidclEmployeePersonalDetails extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_employee_personal_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "title",
        "name",
        "email",
        "mobile_number",
        "alternate_mobile_number",
        "date_of_birth",
        "gender",
        "blood_group",
        "marital_status",
        "wedding_date",
        "country_of_birth",
        "place_of_birth",
        "religion",
        "nationality",
        "ref_caste_id",
        "ex_serviceman",
        "disability",
        "nature_of_disability",
        "language",
        "hobbies",
        "current_address",
        "permanent_address",
        "emergency_contact_name",
        "emergency_contact_relation",
        "emergency_contact_mobile",
        "emergency_contact_alternate_mobile",
        "emergency_contact_address",
        "nok_contact_name",
        "nok_contact_relation",
        "nok_contact_mobile",
        "nok_contact_alternate_mobile",
        "nok_contact_address",
        "father_name",
        "father_dependant",
        "mother_name",
        "mother_dependant",
        "spouse_name",
        "spouse_dependant",
        "child_name",
        "child_dependant",
        "upload_photo",
        "upload_photo_filepath",
        "upload_signature",
        "upload_signature_filepath",
        "upload_resume",
        "upload_resume_filepath",
        "upload_pancard",
        "upload_pancard_filepath",
        "upload_aadhar",
        "upload_aadhar_filepath",
        "upload_address_proof",
        "upload_address_proof_filepath",
        "upload_caste_certificate",
        "upload_caste_certificate_filepath",
        "upload_dob_certificate",
        "upload_dob_certificate_filepath",
        "profile_status",
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

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }
}