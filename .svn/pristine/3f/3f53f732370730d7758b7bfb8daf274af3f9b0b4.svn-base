<?php 

namespace App\Models\TrainingManagement;
use Illuminate\Database\Eloquent\Model;

class TrainingSelfTest extends Model
{
    protected $fillable = [
        'ref_users_id', 'session_id', 'score', 'total_questions', 'attempted_on'
    ];

    public function attendee()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function session()
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
