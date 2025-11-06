<?php

namespace App\Models\Recruitment\CandidateProfile;

use App\Models\RefPassingYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclRpEducationalQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_rp_educational_qualification';

    protected $fillable = [
        'ref_users_id',
        'examination',
        'institute_name',
        'university_board',
        'passing_year',
        'percentage_cgpa',
        'marksheet',
        'marksheet_filepath',
        'edu_confirm',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'passing_year' => 'integer',
        'marks_obtained' => 'float',
    ];

    public function passingYear(){
        return $this->belongsTo(RefPassingYear::class, 'passing_year','id');
    }
}
