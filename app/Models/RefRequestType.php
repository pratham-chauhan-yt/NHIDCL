<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefRequestType extends Model
{
    use HasFactory;
    protected $table = "ref_request_type";
    protected $fillable = [
        "request_type",
        "created_by",
        "updated_by",
    ];
}