<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefDiscipline extends Model
{
    use HasFactory;
    protected $table = "ref_discipline";
    protected $fillable = [
        "discipline_name",
        "created_at",
        "created_by",
    ];
}
