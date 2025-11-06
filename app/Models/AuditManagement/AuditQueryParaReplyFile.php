<?php

namespace App\Models\AuditManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditQueryParaReplyFile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "nhidcl_ams_audit_query_para_replies_file";
    protected $fillable = ['nhidcl_ams_audit_query_para_replies_id', 'file', 'created_by'];

  
}
