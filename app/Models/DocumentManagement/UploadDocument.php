<?php

namespace App\Models\DocumentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadDocument extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'nhidcl_dms_upload_office_order';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

}
