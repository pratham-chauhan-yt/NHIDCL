<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRecruitmentUserInfo extends Model
{
    use HasFactory;
    protected $table = "nhidcl_recruitment_advertisement_user_info";

    protected $fillable = [
        "ref_users_id",
        "nhidcl_recruitment_posts_id",
        "nhidcl_recruitment_posts_eligibility_criteria_id",
        "ref_mode_of_recruitment_id",
        "salary_slip_five_month",
        "capital_share_ten_year",
        "councel_registration_certificate",
        "created_by",
        "updated_by",
        "deteted_at",
        "is_deleted"
    ];

    public function scopeOfUser($query, $user_id)
    {
        return $query->where("ref_users_id", $user_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id','id');
    }
}