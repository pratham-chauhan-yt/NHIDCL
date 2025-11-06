<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhidclReceiving extends Model
{
    public $timestamps = false;
    protected $table = 'nhidcl_bgm_receiving';

    protected $fillable = [
        "nhidcl_bgm_bank_guarantees_id",
        "status",
        "receiving_file",
        "created_by",
        "created_at",
        "verified_by",
        "physical_location",
        "reason"
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function VerifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
