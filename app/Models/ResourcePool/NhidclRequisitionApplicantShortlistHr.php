<?php

namespace App\Models\ResourcePool;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRequisitionApplicantShortlistHr extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_requisition_applicant_shortlist_hr'; // Explicit table name

    protected $fillable = [
        'nhidcl_resource_requisition_shortlist_applicant_details_id',
        'ref_users_id',
        'ref_shortlist_status_id',
        'remarks',
        'created_by',
        'updated_by',
        'is_deleted'
    ];

    protected $casts = [
        'is_deleted' => 'boolean', // Assuming it's a boolean flag
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

    public function shortlistStatus()
    {
        return $this->belongsTo(RefShortlistStatus::class, 'ref_shortlist_status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
