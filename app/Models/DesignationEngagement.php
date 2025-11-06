<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignationEngagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_Designation_Engagement';
    public $timestamps = false;
    protected $fillable = [
        'ref_engagement_id',
        'ref_Engagement',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the User model
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
