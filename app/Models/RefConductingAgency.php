<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefConductingAgency extends Model
{
    use HasFactory;

    protected $table ="ref_conducting_agency";
    protected $fillable =[
        "agency_name",
        "created_by",
    ];
    
}
