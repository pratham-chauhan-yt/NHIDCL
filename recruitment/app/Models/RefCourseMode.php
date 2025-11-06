<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCourseMode extends Model
{
    use HasFactory;

    protected $table="ref_course_mode";

    protected $fillable=[
        "course_mode",
        "created_at",
        "created_by",
    ];
}
