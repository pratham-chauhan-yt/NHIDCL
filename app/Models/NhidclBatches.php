<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclBatches extends Model
{
    use HasFactory;

    protected $table ="nhidcl_batches";

    protected $fillable =[
        "exam_interview_timing",
        "is_exam",
        "is_interview",
        "nhidcl_resource_requisition_id"
    ];

    public function resourceRequisition(){
        return $this->belongsTo(NhidclResourceRequisition::class,"nhidcl_resource_requisition_id");
    }

    public function batchCandidates()
    {
        return $this->hasMany(NhidclBatchCandidates::class, 'nhidcl_batches_id', 'id');
    }
}
