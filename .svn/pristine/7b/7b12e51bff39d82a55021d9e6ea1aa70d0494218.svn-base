<?php

namespace App\Models\ResourcePool;

use App\Models\NhidclBatches;
use App\Models\NhidclResourceRequisition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclResourceRequisitionFinalShortlistApplicant extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'nhidcl_resource_requisition_final_shortlist_applicant';

    protected $fillable = [
        'nhidcl_resource_requisition_id',
        'nhidcl_batches_id',
        'ref_users_id',
        'status',
        'offer_letter_file',
        'date_of_joining',
        'remark',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'date_of_joining',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relationships (example)
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function requisition()
    {
        return $this->belongsTo(NhidclResourceRequisition::class, 'nhidcl_resource_requisition_id');
    }

    public function batch()
    {
        return $this->belongsTo(NhidclBatches::class, 'nhidcl_batches_id');
    }
}
