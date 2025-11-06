<?php

namespace App\Models\QueryManagement;

use App\Models\NhidclApplicationStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QmsQueryReply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "nhidcl_qms_query_replies";
    protected $fillable = ['nhidcl_qms_query_details_id', 'message', 'file','created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
