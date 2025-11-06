<?php

namespace App\Models\AuditManagement;

use App\Models\RefAuditLevel;
use App\Models\RefAuditType;
use App\Models\RefProjectState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmsAuditQuery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "nhidcl_ams_audit_query";
    protected $fillable = ['id', 'subject', 'letter_no', 'letter_date', 'from_date', 'to_date', 'ref_project_state_id', 'audit_year', 'ref_audit_level_id', 'ref_audit_type_id', 'pdf_file', 'word_file', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function auditLevel()
    {
        return $this->belongsTo(RefAuditLevel::class, 'ref_audit_level_id');
    }

    public function auditType()
    {
        return $this->belongsTo(RefAuditType::class, 'ref_audit_type_id');
    }

    public function projectState()
    {
        return $this->belongsTo(RefProjectState::class, 'ref_project_state_id');
    }

    public function getRefStatusTextAttribute()
    {
        $statuses = [
            '1' => 'Pending',
            '5' => 'Dropped'
        ];

        return $statuses[$this->ref_status_id] ?? '';
    }

}
