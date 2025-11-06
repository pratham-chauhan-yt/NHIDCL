<?php

namespace App\Models\Recruitment;

use App\Models\RefDiscipline;
use App\Models\RefPassingYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclRpGateScoreDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_rp_gate_score_details';

    protected $fillable = [
        'ref_users_id',
        'ref_passing_year_id',
        'ref_discipline_id',
        'gate_score',
        'gate_registration_number',
        'all_india_rank',
        'number_of_candidate',
        'gate_percentile',
        'gatescore_certificate',
        'gatescore_certificate_filepath',
        'gate_consent',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
        'is_deleted'    => 'boolean',
    ];

    // Relationships
    public function passingYear()
    {
        return $this->belongsTo(RefPassingYear::class, 'ref_passing_year_id');
    }

    public function gateDiscpline()
    {
        return $this->belongsTo(RefDiscipline::class, 'ref_discipline_id');
    }
}