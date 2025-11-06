<?php
namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhidclApplicationStatus;

class NhidclRecruitmentOfferLetter extends Model
{
    use HasFactory;

    protected $table = "nhidcl_recruitment_offer_letter";

    protected $fillable = [
        "nhidcl_recruitment_applications_id",
        "offer_letter_file",
        "offer_letter_path",
        "released_at",
        "nhidcl_application_status_id",
        "accepted_at",
        "created_by",
        "updated_by"
    ];
    
    public function application(){
        return $this->belongsTo(NhidclRecruitmentApplications::class,"nhidcl_recruitment_applications_id");
    }

    public function status(){
        return $this->belongsTo(NhidclApplicationStatus::class,"nhidcl_application_status_id");
    }
}