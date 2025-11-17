<?php 

namespace App\Models\TrainingManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Trainer extends Model
{   
    protected $table = "nhidcl_ems_trainers";
    protected $fillable = [
        'ref_users_id', 'ref_designation_id', 'ref_qualification_id', 'availability', 'cost_per_session', 'created_by', 'updated_by', 'deleted_at'
    ];

    protected $casts = [
        'availability' => 'array', // auto JSON encode/decode
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id')->select('id', 'name', 'email');
    }

    public function sessions()
    {
        return $this->hasMany(TrainingSession::class, "nhidcl_ems_training_sessions_id");
    }

    public function budgets()
    {
        return $this->hasMany(TrainingBudget::class);
    }
}
