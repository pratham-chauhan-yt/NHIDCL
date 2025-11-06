<?php
namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhidclApplicationStatus;

class NhidclRecruitmentCandidateTimeline extends Model
{
    use HasFactory;

    protected $table = "nhidcl_recruitment_candidate_timeline";

    protected $fillable = [
        "ref_users_id",
        "nhidcl_recruitment_applications_id",
        "nhidcl_application_status",
        "remarks",
        "created_by",
    ];
    
    public function application(){
        return $this->belongsTo(NhidclRecruitmentApplications::class,"application_id");
    }

    public function status(){
        return $this->belongsTo(NhidclApplicationStatus::class,"status");
    }
}