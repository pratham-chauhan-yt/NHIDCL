<?php

namespace App\Models\AuditManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditQueryParaReply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "nhidcl_ams_audit_query_para_replies";
    protected $fillable = ['nhidcl_ams_audit_query_para_id', 'remark', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files()
    {
        return $this->hasOne(AuditQueryParaReplyFile::class, 'nhidcl_ams_audit_query_para_replies_id');
    }
}
