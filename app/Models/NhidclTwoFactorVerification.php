<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclTwoFactorVerification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ="nhidcl_two_factor_verification";
    protected $fillable =[
        "type",
        "email_id",
        "mobile_no",
        "otp",
        "otp_count",
        "verify_status",
        "valid_otp_count",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
