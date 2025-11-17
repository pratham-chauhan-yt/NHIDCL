<?php 

namespace App\Models\TrainingManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class TrainingMaterial extends Model
{
    protected $table = 'nhidcl_ems_training_materials';
    protected $fillable = [
        'nhidcl_ems_training_sessions_id', 'upload_file', 'upload_filepath', 'ref_users_id', 'ref_users_id_approver', 'approved_at', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'nhidcl_ems_training_sessions_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'ref_users_id_approver');
    }
}
