<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class RefApplicantPersonalDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        "ref_engagement_id",
        "full_name",
        "father_husband_name",
        "mobile_no",
        "email",
        "gender",
        "date_of_birth",
        "spouse_name",
        "spouse_mobile_no",
        "pincode",
        "correspondence_address",
        "permanent_address",
        'upload_photos',
        'upload_signature',
        'upload_resume',
        "ref_users_id",
        'created_at',
        'upload_photos_filepath',
        'upload_signature_filepath',
        'upload_resume_filepath',
    ];


    public function engagementType(){
        return $this->belongsTo(RefEngagement::class,'ref_engagement_id');
    }

}
