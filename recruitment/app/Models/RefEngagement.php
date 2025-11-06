<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEngagement extends Model
{
    use HasFactory;

    protected $table = "ref_engagement";

    protected $fillable = [
        'engagement_type'
    ];

}
