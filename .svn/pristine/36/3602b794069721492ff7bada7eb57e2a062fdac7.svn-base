<?php

namespace App\Models\ResourcePool;

use App\Models\NhidclResourceRequisition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclResourceRequisitionShortlistApplicantDetail extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_resource_requisition_shortlist_applicant_details'; // Explicitly define table name

    protected $fillable = [
        'nhidcl_resource_requisition_id',
        'ref_shortlist_by_id',
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
    public function requisition()
    {
        return $this->belongsTo(NhidclResourceRequisition::class, 'nhidcl_resource_requisition_id');
    }

    public function shortlistBy()
    {
        return $this->belongsTo(RefShortlistBy::class, 'ref_shortlist_by_id');
    }

    public function shortlistStatus()
    {
        return $this->belongsTo(RefShortlistStatus::class, 'ref_shortlist_status_id');
    }

    public function shortListedCandidateByChairperson(){
        return $this->hasMany(NhidclRequisitionApplicantShortlistChairPerson::class, 'nhidcl_resource_requisition_shortlist_applicant_details_id', 'id');
    }

    public function shortListedCandidateByCommittee(){
        return $this->hasMany(NhidclRequisitionApplicantShortlistCommittee::class, 'nhidcl_resource_requisition_shortlist_applicant_details_id', 'id');
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
