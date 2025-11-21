<?php

namespace App\Models\Recruitment;

use App\Models\Recruitment\AdvertisementPost;
use App\Models\{RefPassingYear, User};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclRPUpscExam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_recruitment_post_upsc_exam';

    protected $fillable = [
        'ref_users_id',
        'nhidcl_recruitment_posts_id',
        'ref_passing_year_id',
        'upsc_cse_roll_number',
        'upsc_cse_mains_marks',
        'upsc_cse_interview_marks',
        'upsc_cse_mains_percentile',
        'interview_call_letter_file',
        'interview_call_letter_filepath',
        'upsc_cse_mains_score_file',
        'upsc_cse_mains_score_filepath',
        'upsc_consent',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
        'is_deleted'    => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }


    public function advertisementPost()
    {
        return $this->belongsTo(AdvertisementPost::class, 'nhidcl_recruitment_posts_id');
    }

    public function passingYear()
    {
        return $this->belongsTo(RefPassingYear::class, 'ref_passing_year_id');
    }
}
