<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitmentAdvertisementNotes extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    protected $table = 'nhidcl_recruitment_advertisement_notes';

    protected $guarded = [];
}
