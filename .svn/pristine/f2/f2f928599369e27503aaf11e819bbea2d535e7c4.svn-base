<?php 

namespace App\Models\TrainingManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User,RefStatus};

class TrainingBudget extends Model
{   
    protected $table = 'nhidcl_ems_training_budget';
    protected $fillable = [
        'nhidcl_ems_training_sessions_id', 'nhidcl_ems_trainers_id', 'amount', 'ref_status_id', 'remarks', 'ref_users_id_approver', 'approved_at', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'nhidcl_ems_trainers_id');
    }

    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'nhidcl_ems_training_sessions_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'ref_users_id_approver');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'ref_status_id');
    }
}
