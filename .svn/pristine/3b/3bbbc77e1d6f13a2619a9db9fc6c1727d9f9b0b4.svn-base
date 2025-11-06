<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefOfficeType extends Model
{
    use SoftDeletes;
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
