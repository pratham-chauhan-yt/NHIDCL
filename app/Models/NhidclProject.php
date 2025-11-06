<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclProject extends Model
{
    use HasFactory;
    protected $table = "nhidcl_bgm_project_details";

    protected $fillable = [
        'project_id',
        'job_no',
        'upc_no',
        'project_name',
        'ref_project_type_id',
        'ref_project_state_id',
        'sap_id',
        "created_by",
        "created_at",
    ];

    public function projectState()
    {
        return $this->belongsTo(RefProjectState::class, 'ref_project_state_id');
    }

    public function projectType()
    {
        return $this->belongsTo(RefProjectType::class, 'ref_project_type_id');
    }

    public function bg()
    {
        return $this->hasMany(NhidclBankGuarantee::class, 'nhidcl_bgm_project_details_id');
    }
}
