<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'ref_user_id',
        'role_id',
        'parent_role_id'
    ];

    function users(){
        return $this->hasMany(User::class,'id','ref_user_id');
    }
}
