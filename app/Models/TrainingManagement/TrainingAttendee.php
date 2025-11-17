<?php 

namespace App\Models\TrainingManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, RefStatus};

class TrainingAttendee extends Model
{   
    protected $table = 'nhidcl_ems_training_employees';
    protected $fillable = [
        'nhidcl_ems_training_sessions_id', 'ref_users_id', 'ref_status_id', 'check_in_time', 'check_out_time', 'certificate', 'certificate_filepath', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'nhidcl_ems_training_sessions_id');
    }

    public function attendee()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'ref_status_id');
    }
}
