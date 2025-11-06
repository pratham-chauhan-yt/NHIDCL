<?php

namespace App\Models\AuditManagement;

use App\Models\DepartmentMaster;
use App\Models\RefAuditLevel;
use App\Models\RefAuditQueryType;
use App\Models\RefAuditType;
use App\Models\RefOfficeType;
use App\Models\RefParaPart;
use App\Models\RefProjectState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditQueryPara extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "nhidcl_ams_audit_query_para";
    protected $fillable = ['id', 'nhidcl_ams_audit_query_id', 'year', 'title', 'brief_para', 'ref_query_type_id', 'ref_part_id', 'pdf_file_path', 'word_file_path', 'ref_office_id', 'ref_department_id', 'assign_to', 'created_by', 'ref_status_id', 'status_dropped_date'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function auditQuery()
    {
        return $this->belongsTo(AmsAuditQuery::class, 'nhidcl_ams_audit_query_id');
    }

    public function queryType()
    {
        return $this->belongsTo(RefAuditQueryType::class, 'ref_query_type_id');
    }

    public function part()
    {
        return $this->belongsTo(RefParaPart::class, 'ref_part_id');
    }

    public function department()
    {
        return $this->belongsTo(DepartmentMaster::class, 'ref_department_id');
    }

    public function office()
    {
        return $this->belongsTo(RefOfficeType::class, 'ref_office_id');
    }

    public function getRefStatusTextAttribute()
    {
        $statuses = [
            '8' => 'Reply Pending',
            '6' => 'Replied',
            '5' => 'Dropped',
        ];

        return $statuses[$this->ref_status_id] ?? '';
    }
}
