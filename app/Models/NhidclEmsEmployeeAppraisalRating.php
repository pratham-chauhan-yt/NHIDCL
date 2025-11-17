<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclEmsEmployeeAppraisalRating extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_ems_employee_appraisal_rating';

    protected $fillable = [
        'nhidcl_ems_appraisal_details_id',
        'goal_title',
        'self_rating',
        'hr_rating',
        'gm_rating',
        'comment',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'is_deleted',
    ];
    // Relation to Appraisal Details
    public function appraisalDetail()
    {
        return $this->belongsTo(NhidclEmsEmployeeAppraisalDetail::class, 'nhidcl_ems_appraisal_details_id');
    }

    // Relation to Creator (User)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
