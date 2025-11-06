<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grievance extends Model
{
    use HasFactory;

    use SoftDeletes;
    public $timestamps = false;

    protected $table = 'nhidcl_gms_grievance_application';

    protected $fillable = [
        'ref_users_id',
        'grievance_id',
        'title',
        'name',
        'employee_code',
        'ref_designation_id',
        'ref_department_id',
        'pay_scale',
        'address',
        'message',
        'date',
        'ref_assign_users_id',
        'handled_at',
        'upload_file',
        'upload_file_path',
        'escalation_level',
        'type',
        'meta',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($grievance) {
            $last = self::orderBy('id', 'desc')->first();
            $number = $last ? intval(substr($last->grievance_id, -4)) + 1 : 1;
            $grievance->grievance_id = 'NHIDCL/GRV/' . date('Y') . '/' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'ref_users_id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'ref_assign_users_id');
    }

    public function logs()
    {
        return $this->hasMany(GrievanceLog::class, 'nhidcl_gms_grievance_application_id');
    }

    public function designation()
    {
        return $this->belongsTo(DesignationMaster::class, 'ref_designation_id');
    }

    public function department()
    {
        return $this->belongsTo(DepartmentMaster::class, 'ref_department_id');
    }
}
