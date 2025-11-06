<?php

namespace App\Models\DocumentManagement;

use App\Models\DepartmentMaster;
use App\Models\RefPassingYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclDmsUploadOfficeOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_dms_upload_office_order';

    protected $fillable = [
        'ref_type_of_document_id',
        'title',
        'file_number',
        'issue_date',
        'ref_type_id',
        'ref_department_id',
        'year',
        'tag_user',
        'document',
        'document_filepath',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'issue_date'   => 'date',
        'year'         => 'integer',
        'is_deleted'   => 'boolean',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    // Belongs to RefTypeOfDocument
    public function typeOfDocument()
    {
        return $this->belongsTo(RefTypeOfDocument::class, 'ref_type_of_document_id');
    }

    // Belongs to RefType
    public function type()
    {
        return $this->belongsTo(RefType::class, 'ref_type_id');
    }

    // Belongs to RefDepartment
    public function department()
    {
        return $this->belongsTo(DepartmentMaster::class, 'ref_department_id');
    }

    // Belongs to RefPassingYear
    public function passingYear()
    {
        return $this->belongsTo(RefPassingYear::class, 'year',);
    }

    // Belongs to Users
    public function taggedUser()
    {
        return $this->belongsTo(User::class, 'tag_user');
    }
}
