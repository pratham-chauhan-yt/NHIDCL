<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRequisitionCourse extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_requisition_course';

    protected $fillable = [
        'nhidcl_resource_requisition_id',
        'ref_course_id',  
    ];
}
