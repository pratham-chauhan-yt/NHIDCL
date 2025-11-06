<?php

namespace App\Models;

use App\Models\ResourcePool\NhidclResourceRequisitionShortlistApplicantDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefDomain;
use App\Models\RefQualification;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclResourceRequisition extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "nhidcl_resource_requisition";
    protected $fillable = [
        "ref_independent_consultant_id",
        "ref_expert_professional_id",
        "ref_people_of_eminence_id",
        "number_of_required_resources",
        "engagement_year",
        "engagement_month",
        "ref_domain_id",
        "ref_discipline_id",
        "ref_qualification_id",
        "ref_work_experience_year_id",
        "retired_government_personnel",
        "comment_box",
        "upload_for_efile_noting",
        "created_at",
        "created_by",
        "job_title",
        "job_description",
        "ref_engagement_id",
        "ref_chairperson_id",
        "nhidcl_engagement_designation_id",
        "start_date",
        "end_date",
        "qualification_percent",
        "newspaper_publication_date",
        "newspaper_clipping",
        "upload_for_efile_noting_filepath",
        "newspaper_clipping_filepath"
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function workExp()
    {
        return $this->belongsTo(RefWorkExperienceYear::class, 'ref_work_experience_year_id', 'id');
    }

    public function shortlistApplicantDetails()
    {
        return $this->hasMany(NhidclResourceRequisitionShortlistApplicantDetail::class, 'nhidcl_resource_requisition_id');
    }
}
