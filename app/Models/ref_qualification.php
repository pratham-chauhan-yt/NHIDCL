<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ref_qualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_qualification';

    protected $fillable = [
        'qualification_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Define the relationship with the RefCourse model
    public function refCourses()
    {
        return $this->hasMany(RefCourse::class, 'ref_qualification_id');
    }
}
