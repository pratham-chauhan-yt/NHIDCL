<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclBankGuarantee extends Model
{
    use HasFactory;
    protected $table = "nhidcl_bgm_bank_guarantees";

    protected $fillable = [
        "nhidcl_bgm_project_details_id",
        "bg_id",
        "ref_guarantee_type_id",
        "agency_name",
        "agency_mob_no",
        "agency_email",
        "agency_address",
        "bg_no",
        "bank_name",
        "issuing_bank_branch",
        "issuing_bank_mob_no",
        "issuing_bank_email",
        "issuing_bank_address",
        "operable_bank_mob_no",
        "operable_bank_email",
        "operable_bank_address",
        "operable_bank_branch",
        "bg_amount",
        "issue_date",
        "bg_valid_upto",
        "claim_expiry_date",
        "bg_file",
        "created_by",
        "updated_by",
        'status',
        'remarks',
        'verified_status',
        'verified_by',
        'verified_at',
        'mode_of_confirmation_master_id',
        'physical_location',
        'mode_of_confirmation_file',
        'confirmation_uploaded_date',
        'confirmation_uploaded_by',
        'accepted_or_returned_by',
        'accepted_or_returned_date',
        'refer_back_remark',
        'claim_lodged',
        'operable_bank_name',
        'issuing_bank_name'
    ];



    public function project()
    {
        return $this->belongsTo(NhidclProject::class, 'nhidcl_bgm_project_details_id');
    }
    public function guaranteeType()
    {
        return $this->belongsTo(RefGuaranteeType::class, 'ref_guarantee_type_id');
    }

    public function renewals()
    {
        return $this->hasMany(NhidclRenewBg::class, 'nhidcl_bgm_bank_guarantees_id');
    }
    public function receiving()
    {
        return $this->hasMany(NhidclReceiving::class, 'nhidcl_bgm_bank_guarantees_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function VerifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
