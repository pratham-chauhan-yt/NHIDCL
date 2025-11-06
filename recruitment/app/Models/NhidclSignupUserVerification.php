<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclSignupUserVerification extends Model
{
    use HasFactory;

    protected $table ="nhidcl_signup_user_verification";
    protected $fillable =[
        "email_id",
        "mobile_no",
        "otp",
        "otp_count",
        "created_at",
        "updated_at",
    ];
}
