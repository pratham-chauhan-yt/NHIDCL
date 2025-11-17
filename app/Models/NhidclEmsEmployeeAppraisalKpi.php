<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclEmsEmployeeAppraisalKpi extends Model
{
    use HasFactory;

      protected $table = 'nhidcl_ems_employee_appraisal_kpi';
 
    
    protected $fillable = [
        'kpi_name',
        'nhidcl_ems_employee_appraisal_cycle_id',
        'ref_status_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
        'is_deleted',
       

    ];
}
