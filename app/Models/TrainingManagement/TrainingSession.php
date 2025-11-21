<?php 

namespace App\Models\TrainingManagement;

use App\Models\RefStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingSession extends Model
{   
    use SoftDeletes;
    protected $table = 'nhidcl_ems_training_sessions';
    protected $fillable = [
        'nhidcl_ems_trainers_id', 'name', 'agenda', 'address', 'date', 'duration', 'ref_status_id', 'type', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'nhidcl_ems_trainers_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'nhidcl_ems_training_employees', 'nhidcl_ems_training_sessions_id', 'ref_users_id')
                    ->withPivot(['ref_status_id', 'check_in_time', 'check_out_time', 'certificate'])
                    ->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(TrainingMaterial::class, 'nhidcl_ems_training_sessions_id');
    }

    public function budgets()
    {
        return $this->hasOne(TrainingBudget::class, 'nhidcl_ems_training_sessions_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'ref_status_id');
    }
}
