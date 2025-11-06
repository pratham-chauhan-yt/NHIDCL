<?php

namespace App\Models\DocumentManagement;

use App\Models\RefStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclDmsShareDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_dms_share_document';

    protected $fillable = [
        'title',
        'remark',
        'share_type',
        'ref_users_id',
        'ref_status_id',
        'approved_or_rejected_by',
        'approver_remark',
        'document',
        'document_filepath',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'ref_status_id' => 'integer',
        'is_deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Each document is shared with a user
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'ref_status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_or_rejected_by');
    }
}
