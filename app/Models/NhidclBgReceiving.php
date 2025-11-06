<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclBgReceiving extends Model
{
    use HasFactory;
    protected $table = "nhidcl_bgm_receiving";

    protected $fillable = [
        "nhidcl_bgm_bank_guarantees_id",
        "status",
        "reason",
        "verified_by",
        "receiving_file",
        "bg_file",
        "created_by",
        "updated_by",
        'remarks',
        'verified_by',
        'verified_at'
    ];

}
