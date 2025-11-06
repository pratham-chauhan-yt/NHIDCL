<?php

namespace App\Models\DocumentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'ref_type_of_document';
}
