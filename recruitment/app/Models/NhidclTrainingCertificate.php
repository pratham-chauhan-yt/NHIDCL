<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclTrainingCertificate extends Model
{
    use HasFactory;

    protected $table ="nhidcl_training_certificate";

    protected $fillable=[
        "name_of_training",
        "training_start_date",
        "training_end_date",
        "description",
        "certificate_expiry_date",
        "training_certificate",
        "ref_users_id",
        "created_at",
        "training_certificate_filepath"
    ];
}
