<?php

namespace App\Models\DocumentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefTypeOfDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_type_of_document';

    protected $fillable = [
        'document_type',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'is_deleted' => 'boolean',
    ];
}
