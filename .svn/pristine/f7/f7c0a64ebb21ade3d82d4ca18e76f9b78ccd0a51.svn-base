<?php
namespace App\Models\Recruitment;

use App\Models\Recruitment\NhidclRecruitmentApplications;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclRecruitmentApplicationsLogs extends Model
{
    use HasFactory;
    protected $table = "nhidcl_recruitment_applications_logs";

    protected $fillable = [
        "ref_users_id",
        "nhidcl_recruitment_applications_id",
        "name",
        "latitude",
        "longitude",
        "ip_address",
        "datetime",
        "status",
        "comment",
        "upload_file",
        "upload_file_path",
        "created_by",
        "updated_by",
    ];
    public function users(){
        return $this->belongsTo(User::class, 'ref_users_id')
                ->select('id', 'name', 'email', 'mobile', 'date_of_birth');
    }

    public function application(){
        return $this->belongsTo(NhidclRecruitmentApplications::class, 'nhidcl_recruitment_applications_id');
    }
}