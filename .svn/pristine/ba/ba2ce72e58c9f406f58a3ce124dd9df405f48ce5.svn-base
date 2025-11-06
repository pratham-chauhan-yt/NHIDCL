<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRenewBg extends Model
{
    use HasFactory;
    protected $table = "nhidcl_bgm_renew_bg";

    protected $fillable = [
        'nhidcl_bgm_bank_guarantees_id',
        'issue_date',
        'valid_upto',
        'claim_expiry_date',
        'renew_bg_file',
        'is_renew',
        "created_by",
        "updated_by",
        "deteted_at",
        "is_deleted",
        'status',
        'remarks',
        'verified_by',
        'verified_at',
        'physical_location',
        'project_id',
        'verified_date',
        'mode_of_confirmation_master_id',
        'mode_of_confirmation_file',
        'confirmation_uploaded_date',
        'confirmation_uploaded_by',
        'physical_custody',
        'uploaded_by',
        'uploaded_date',
        'accepted_or_returned_by',
        'accepted_or_returned_date',
        'refer_back_reason',
        'added_date',
        'e_renewal'
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
