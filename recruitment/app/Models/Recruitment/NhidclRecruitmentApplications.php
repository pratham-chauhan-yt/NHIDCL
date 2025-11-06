<?php
namespace App\Models\Recruitment;

use App\Models\Recruitment\Advertisement;
use App\Models\Recruitment\AdvertisementPost;
use App\Models\Recruitment\NhidclRecruitmentInterviews;
use App\Models\NhidclApplicationStatus;
use App\Models\Recruitment\CandidateProfile\NhidclRpApplicantPersonalDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRecruitmentApplications extends Model
{
    use HasFactory;

    protected $table = "nhidcl_recruitment_applications";
    protected $fillable = [
        "ref_users_id",
        "nhidcl_recruitment_advertisement_id",
        "nhidcl_recruitment_posts_id",
        "nhidcl_application_status_id",
        "consent_one",
        "consent_two",
        "consent_three",
        "consent_four",
        "consent_five",
        "place_of_application",
        "action",
        "applied_at",
        "resume_file",
        "resume_path",
        "ref_users_assigned_id",
        "display_time",
        "created_by",
        "updated_by",
    ];
    
    public function users(){
        return $this->belongsTo(User::class, 'ref_users_id')
                ->select('id', 'name', 'email', 'mobile', 'date_of_birth');
    }

    public function advertisement(){
        return $this->belongsTo(Advertisement::class,"nhidcl_recruitment_advertisement_id");
    }

    public function advertisementPost(){
        return $this->belongsTo(AdvertisementPost::class,"nhidcl_recruitment_posts_id");
    }

    public function status(){
        return $this->belongsTo(NhidclApplicationStatus::class,"nhidcl_application_status_id")
            ->select('id', 'status', 'type');
    }



    public function interview()
    {
        return $this->hasOne(NhidclRecruitmentInterviews::class, 'nhidcl_recruitment_applications_id')
            ->select('id', 'nhidcl_recruitment_applications_id', 'nhidcl_application_status_id', 'remarks', 'scheduled_at');
    }

    public function gatescore()
    {
        return $this->hasMany(
            NhidclRpGateScoreDetails::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }

    public function application()
    {
        return $this->hasMany(
            NhidclRpApplicantPersonalDetails::class,
            'ref_users_id', // foreign key in education table
            'ref_users_id'  // local key in personal details table
        );
    }
}