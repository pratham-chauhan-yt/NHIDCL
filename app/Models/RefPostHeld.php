<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPostHeld extends Model
{
    use HasFactory;

    protected $table="ref_post_held";

    protected $fillable=['post_held'];
}
