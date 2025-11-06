<?php

namespace App\Models\ResourcePool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefShortlistStatus extends Model
{
    use HasFactory;

    protected $table = 'ref_shortlist_status';

    protected $fillable = [
        'shortlisted_status',
        'created_by',
    ];

    protected $casts = [
        'is_deleted' => 'boolean', // Ensures correct type handling
        'created_at' => 'datetime',
    ];
}
