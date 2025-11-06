<?php

namespace App\Models\Recruitment;

use App\Models\RefGateDiscipline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclRecruitmentPostGateDiscipline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_recruitment_post_gate_discipline';

    protected $fillable = [
        'nhidcl_recruitment_posts_id',
        'ref_gate_discipline_id',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'is_deleted' => 'boolean',
    ];

    // Relationships
    public function advertisementPost()
    {
        return $this->belongsTo(AdvertisementPost::class, 'nhidcl_recruitment_posts_id');
    }

    public function gateDiscipline()
    {
        return $this->belongsTo(RefGateDiscipline::class, 'ref_gate_discipline_id');
    }
}
