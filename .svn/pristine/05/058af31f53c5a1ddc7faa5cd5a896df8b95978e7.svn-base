<?php
namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhidclApplicationStatus;

class NhidclRecruitmentInterviews extends Model
{
    use HasFactory;

    protected $table = "nhidcl_recruitment_interviews";

    protected $fillable = [
        "type",
        "nhidcl_recruitment_applications_id",
        "nhidcl_application_status_id",
        "scheduled_at",
        "assesment_date",
        "remarks",
        "created_by",
        "updated_by",
    ];
    
    public function application(){
        return $this->belongsTo(NhidclRecruitmentApplications::class,"nhidcl_recruitment_applications_id");
    }

    public function status(){
        return $this->belongsTo(NhidclApplicationStatus::class,"nhidcl_application_status_id")
            ->select('id', 'status', 'type');
    }
}