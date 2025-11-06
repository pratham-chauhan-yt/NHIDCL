<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignationMaster extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'ref_designation';

    protected $fillable = [
        'name',
        'is_deleted'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
