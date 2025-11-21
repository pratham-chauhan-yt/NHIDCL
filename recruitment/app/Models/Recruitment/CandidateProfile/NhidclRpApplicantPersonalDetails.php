<?php

namespace App\Models\Recruitment\CandidateProfile;

use App\Models\RefCaste;
use App\Models\RefState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Recruitment\CandidateProfile\NhidclRpEducationalQualification;
use App\Models\Recruitment\NhidclRpGateScoreDetails;
use App\Models\Recruitment\CandidateProfile\NhidclRpWorkExperience;
use App\Models\Recruitment\NhidclRPUpscExam;

class NhidclRpApplicantPersonalDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_rp_applicant_personal_details';

    protected $fillable = [
        'ref_users_id',
        'name',
        'mobile',
        'email',
        'date_of_birth',
        'father_husband_name',
        'mother_name',
        'marital_status',
        'spouse_name',
        'gender',
        'aadhar_number',
        'ref_caste_id',
        'pwbd',
        'disability',
        'ex_serviceman',
        'correspondence_address',
        'correspondence_city',
        'ref_correspondence_state_id',
        'correspondence_pincode',
        'permanent_address',
        'permanent_city',
        'ref_permanent_state_id',
        'permanent_pincode',
        'upload_photos',
        'upload_photos_filepath',
        'upload_signature',
        'upload_signature_filepath',
        'upload_caste_certificate',
        'upload_caste_certificate_filepath',
        'upload_disability_proof',
        'upload_disability_proof_filepath',
        'upload_dob_proof',
        'upload_dob_proof_filepath',
        'upload_ex_serviceman_proof',
        'upload_ex_serviceman_proof_filepath',
        'upload_identity_proof',
        'upload_identity_proof_filepath',
        'disability_consent',
        'priority_choice_first',
        'ref_priority_first_state_id',
        'priority_choice_second',
        'ref_priority_second_state_id',
        'priority_choice_third',
        'ref_priority_third_state_id',
        'religion',
        'indian_citizen',
        'serve_location',
        'disease_status',
        'gate_terms_agreement',
        'place_of_application',
        'edu_confirm',
        'category_confirm',
        'ex_serviceman_consent',
        'citizenship_consent',
        'dob_consent',
        'state_group_confirm',
        'submit_experience',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'ex_serviceman' => 'boolean',
        'correspondence_pincode' => 'string',
        'permanent_pincode' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id')->select('id', 'name', 'email', 'mobile', 'date_of_birth', 'ref_department_id');
    }

    public function education()
    {
        return $this->hasMany(
            NhidclRpEducationalQualification::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }

    public function gatescore()
    {
        return $this->hasMany(
            NhidclRpGateScoreDetails::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }

    public function upscscore()
    {
        return $this->hasMany(
            NhidclRPUpscExam::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }

    public function experience()
    {
        return $this->hasMany(
            NhidclRpWorkExperience::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }

    public function caste()
    {
        return $this->belongsTo(RefCaste::class, 'ref_caste_id');
    }

    public function correspondenceState()
    {
        return $this->belongsTo(RefState::class, 'ref_correspondence_state_id')->select('id','name');
    }

    public function permanentState()
    {
        return $this->belongsTo(RefState::class, 'ref_permanent_state_id')->select('id','name');
    }

    // public function choiceStateFirst()
    // {
    //     $ids = $this->ref_priority_first_state_id ?? [];
    //     if (!is_array($ids)) {
    //         $ids = json_decode($ids, true) ?: [];
    //     }

    //     // convert string numbers to integers
    //     $ids = array_map('intval', $ids);

    //     return RefState::whereIn('id', $ids)->get();
    // }

    // public function choiceStateSecond()
    // {
    //     $ids = $this->ref_priority_second_state_id ?? [];
    //     if (!is_array($ids)) {
    //         $ids = json_decode($ids, true) ?: [];
    //     }
    //     return $this->hasMany(RefState::class, 'id')->whereIn('id', $ids);
    // }

    // public function choiceStateThird()
    // {
    //     $ids = $this->ref_priority_third_state_id ?? [];
    //     if (!is_array($ids)) {
    //         $ids = json_decode($ids, true) ?: [];
    //     }
    //     return $this->hasMany(RefState::class, 'id')->whereIn('id', $ids);
    // }

    // public function getChoiceStateFirstAttribute()
    // {
    //     $ids = $this->ref_priority_first_state_id ?? [];
    //     if (!is_array($ids)) {
    //         $ids = json_decode($ids, true) ?: [];
    //     }
    //     $ids = array_map('intval', $ids);
    //     return RefState::whereIn('id', $ids)->get();
    // }

    // public function getChoiceStateSecondAttribute()
    // {
    //     $ids = json_decode($this->attributes['ref_priority_second_state_id'] ?? '[]', true);
    //     if (empty($ids)) {
    //         return collect(); // return empty collection
    //     }
    //     return RefState::whereIn('id', $ids)->get();
    // }

    // public function getChoiceStateThirdAttribute()
    // {   
    //     $ids = $this->ref_priority_third_state_id ?? [];
    //     if (!is_array($ids)) {
    //         $ids = json_decode($ids, true) ?: [];
    //     }
    //     $ids = array_map('intval', $ids);
    //     return RefState::whereIn('id', $ids)->get();
    // }
}
