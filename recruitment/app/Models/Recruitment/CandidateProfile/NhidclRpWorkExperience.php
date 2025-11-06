<?php

namespace App\Models\Recruitment\CandidateProfile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclRpWorkExperience extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_rp_work_experience';

    protected $fillable = [
        'ref_users_id',
        'employer_name',
        'post_held',
        'from_date',
        'to_date',
        'job_description',
        'experience_certificate',
        'experience_certificate_filepath',
        'experience_consent',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
