<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RefModeOfRecruitment;
use App\Models\Recruitment\Advertisement;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $table = 'nhidcl_recruitment_posts';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function advertisement()
    {   
        return $this->belongsTo(Advertisement::class, 'nhidcl_recruitment_advertisement_id', 'id');
    }

    public function getPostLocation()
    {
        return $this->hasMany(PostLocation::class, 'nhidcl_recruitment_posts_id', 'id');
    }

    public function getPostQulification()
    {
        return $this->hasMany(PostEducation::class, 'nhidcl_recruitment_posts_id', 'id');
    }

    public function getPostCourse()
    {
        return $this->hasMany(PostCourse::class, 'nhidcl_recruitment_posts_id', 'id');
    }

    public function gateExamYears()
    {
        return $this->hasMany(NhidclRecruitmentPostGateExam::class, 'nhidcl_recruitment_posts_id');
    }

    public function gateDisciplines()
    {
        return $this->hasMany(NhidclRecruitmentPostGateDiscipline::class, 'nhidcl_recruitment_posts_id');
    }

    public function moderecruitment()
    {
        return $this->belongsTo(RefModeOfRecruitment::class, 'mode_of_requirement', 'id');
    }

    public function application()
{
    return $this->hasMany(NhidclRecruitmentApplications::class, 'nhidcl_recruitment_posts_id', 'id');
}

}
