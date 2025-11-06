<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefQualification extends Model
{
    use HasFactory;

    protected $table = 'ref_qualification';

    protected $fillable = [
        'id',
        'qualification_name',
        'created_by',
        'updated_by',
        'deleted_by',
        'parent_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];


    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
