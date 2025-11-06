<?php

namespace App\Models\TaskManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    use HasFactory;
    protected $table = "nhidcl_mdtm_task_details";

    protected $fillable = [
        'task_name',
        'ref_bucket_id',
        'division',
        'ref_priority_id',
        'start_date',
        'due_date',
        'ref_task_repeat_id',
        'note',
        'ref_task_source_id',
        'assigned_to',
        'upload_attachment',
        'other_task_source',
        'task_id',
        'frequency',
        'is_recurring',
        'parent_task_id',
        'created_by',
        'updated_by',
    ];
    
    protected $casts = [
        'status' => \App\Enums\TaskStatus::class,
        'due_date' => 'datetime',
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'ref_priority_id', 'id');
    }
    public function bucket()
    {
        return $this->belongsTo(Bucket::class, 'ref_bucket_id', 'id');
    }
    public function repeat()
    {
        return $this->belongsTo(TaskRepeat::class, 'ref_task_repeat_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(TaskReply::class, 'nhidcl_mdtm_task_details_id', 'id');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function childTasks()
    {
        return $this->hasMany(self::class, 'parent_task_id');
    }

}
