<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;
    protected $table="nhidcl_user_activities";

    protected $fillable = [
        'ref_users_id',
        'activity',
        'ip_address',
        'browser', 
        'device',
        'platform',
    ];

    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email');
    }
}
