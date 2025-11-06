<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RefPassingYear;

class NhidclCompetitiveExams extends Model
{
    use HasFactory;
    protected $table="nhidcl_competitive_exams";

    protected $fillable =[
        "ref_exam_id",
        "appearing_year",
        "score",
        "certificate",
        "ref_conducting_agency_id",
        "created_at",
        "ref_users_id",
        "certificate_filepath"
    ];

    public function examDetails()
    {
        return $this->belongsTo(RefExam::class, 'ref_exam_id','id');

    }
    public function appearingYear(){
        return $this->belongsTo(RefPassingYear::class, 'appearing_year','id');
    }

    public function conductingAgency()
    {
        return $this->belongsTo(RefConductingAgency::class, 'ref_conducting_agency_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_users_id','id');
    }

}
