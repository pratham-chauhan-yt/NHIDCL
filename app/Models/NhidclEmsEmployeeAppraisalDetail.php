<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclEmsEmployeeAppraisalDetail extends Model
{
    use HasFactory;

    
     protected $table = 'nhidcl_ems_employee_appraisal_details';
 
    
    protected $fillable = [
        'ref_users_id',
        'nhidcl_ems_employee_appraisal_cycle_id',
        'ref_users_id_hr',
        'ref_users_id_gm',
        'ref_status_id_hr',
        'ref_status_id_gm',
        'appraisal_percentage',
        'comment',
        'submitted_at',
        'approved_at',
        'created_by',
        'updated_by'

    ];
}
