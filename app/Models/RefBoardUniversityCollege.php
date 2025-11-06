<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBoardUniversityCollege extends Model
{
    use HasFactory;

    protected $table="ref_board_university_college";

    protected $fillable=[
        "name",
        "created_at",
        "created_by",
        "is_deleted",
    ];
}
