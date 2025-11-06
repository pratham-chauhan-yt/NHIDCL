<?php

namespace App\Models\TaskManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ModuleActivity extends Model
{
    use HasFactory;
    protected $table="nhidcl_module_activity_log";

    protected $fillable = [
        'module',
        'ref_users_id',
        'description',
        'ip_address',
        'event',
        'created_by', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}