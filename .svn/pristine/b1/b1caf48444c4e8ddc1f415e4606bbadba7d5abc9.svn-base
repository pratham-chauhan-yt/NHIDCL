<?php

namespace App\Models\ResourcePool;

use App\Models\RefInterviewStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRequisitionApplicantShortlistChairPerson extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_requisition_applicant_shortlist_chair_person'; // Explicit table name

    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'nhidcl_resource_requisition_shortlist_applicant_details_id',
        'ref_users_id',
        'created_by',
        'updated_by',
        'is_deleted',
        'ref_interview_status_id',
        'remark',
    ];

    protected $casts = [
        'is_deleted' => 'boolean', // Ensures correct type handling
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true; // Manages `created_at` and `updated_at`

    // Define Relationships
    public function shortlistApplicantDetails()
    {
        return $this->belongsTo(NhidclResourceRequisitionShortlistApplicantDetail::class, 'nhidcl_resource_requisition_shortlist_applicant_details_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function shortlistStatus()
    {
        return $this->belongsTo(RefInterviewStatus::class, 'ref_interview_status_id');
    }
}
