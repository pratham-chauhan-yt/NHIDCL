<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrievanceLog extends Model
{   
    use HasFactory;

    use SoftDeletes;
    public $timestamps = false;

    protected $table = 'nhidcl_gms_grievance_logs';
    protected $fillable = [
        'nhidcl_gms_grievance_application_id', 'ref_users_id', 'action', 'comment', 'meta', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'id_deleted'
    ];

    protected $casts = ['meta' => 'array'];

    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }
}