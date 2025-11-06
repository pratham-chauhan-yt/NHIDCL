<?php

namespace App\Models\QueryManagement;

use App\Models\NhidclApplicationStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QmsRefQueryType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "ref_qms_query_type";
    protected $fillable = ['query_type', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
