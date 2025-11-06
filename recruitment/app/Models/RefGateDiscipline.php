<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefGateDiscipline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_gate_discipline';

    protected $fillable = [
        'discipline_name',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
        'is_deleted'   => 'boolean',
    ];
}
