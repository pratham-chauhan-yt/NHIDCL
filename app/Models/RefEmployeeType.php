<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefEmployeeType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ref_employee_type';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_deleted',
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
}
