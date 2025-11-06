<?php

namespace App\Models\TaskManagement;

use App\Traits\TrackUserAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReply extends Model
{
    use HasFactory, TrackUserAction;
    protected $table = "nhidcl_mdtm_task_replies";

    protected $fillable = [
        'nhidcl_mdtm_task_details_id',
        'remarks',
        'file',
        'created_by',
        'created_at',
    ];
    public $timestamps = false;

    public function detail()
    {
        return $this->belongsTo(TaskDetail::class, 'nhidcl_mdtm_task_details_id', 'id');
    }
}
