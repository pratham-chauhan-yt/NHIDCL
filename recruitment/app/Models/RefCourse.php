<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCourse extends Model
{
    use HasFactory;

    protected $table="ref_course";

    protected $fillable=[
        "course_name",
        "ref_qualification_id",
        "created_by",
        "created_at",
        "updated_at",
        "is_deleted",
    ];

    public function refQualification()
    {
        return $this->belongsTo(RefQualification::class, 'ref_qualification_id');
    }
}
