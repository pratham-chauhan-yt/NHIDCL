<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJobType extends Model
{
    use HasFactory;
    protected $table="ref_job_type";

    protected $fillable=[
        "job_type",
        "created_at",
        "created_by",
    ];
}
