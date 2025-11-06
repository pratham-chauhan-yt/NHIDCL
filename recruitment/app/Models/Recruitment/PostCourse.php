<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostCourse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nhidcl_recruitment_post_course';

    protected $guarded = [];
}
