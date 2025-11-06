<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclBatchCandidates extends Model
{
    use HasFactory;

    protected $table ="nhidcl_batch_candidates";

    protected $fillable =[
        "ref_users_id",
        "nhidcl_batches_id",
    ];

    public function user(){
        return $this->belongsTo(User::class,"ref_users_id");
    }

    public function batch(){
        return $this->belongsTo(NhidclBatches::class,"nhidcl_batches_id");
    }

}
