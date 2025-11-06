<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitionQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_requisition_qualification';

    protected $fillable = [
        'nhidcl_resource_requisition_id',
        'ref_qualification_id',  
    ];

    
    // Define the relationship with the User model
   
}
