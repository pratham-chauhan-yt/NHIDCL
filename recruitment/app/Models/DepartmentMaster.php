<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentMaster extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'ref_department';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
