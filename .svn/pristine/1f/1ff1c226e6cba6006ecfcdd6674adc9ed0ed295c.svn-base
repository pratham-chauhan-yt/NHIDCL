<?php 

namespace App\Models\TrainingManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User,RefStatus};

class TrainingRequest extends Model
{   
    protected $table = 'nhidcl_ems_training_requests';
    protected $fillable = [
        'ref_users_id', 'training_topic', 'message', 'ref_status_id', 'hr_message', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function attendee()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'ref_status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }
}
