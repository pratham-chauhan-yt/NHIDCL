<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefOfficeType extends Model
{
    protected $table = 'ref_office_type';

    protected $fillable = [
        'office_type_name',
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
}
