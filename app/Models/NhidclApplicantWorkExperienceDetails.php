<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclApplicantWorkExperienceDetails extends Model
{
    use HasFactory;

    protected $fillable=[
        "employer_name",
        "ref_post_held_id",
        "post_held",
        "from_date",
        "to_date",
        "nature_of_duties",
        "employer_details",
        "ref_job_type_id",
        "experience_certificate",
        "ref_users_id",
        "create_at",
        "ref_area_experties_id",
        "other_area_of_expertise",
        "ref_work_experience_year_id",
        "experience_certificate_filepath"
    ];

    public function post_held()
    {
        return $this->belongsTo(RefPostHeld::class, 'ref_post_held_id');
    }

    public function job_type()
    {
        return $this->belongsTo(RefJobType::class, 'ref_job_type_id');
    }

    public function area_experties()
    {
        return $this->belongsTo(RefAreaExperties::class, 'ref_area_experties_id');
    }

    public function work_experience()
    {
        return $this->belongsTo(RefWorkExperienceYear::class, 'ref_work_experience_year_id');
    }


}
