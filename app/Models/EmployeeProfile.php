<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeProfile extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'nhidcl_employee_profile';

    protected $fillable = [
        'first_name',
        'last_name',
        'qualification',
        'designation_id',
        'employee_type',
        'date_of_joining',
        'date_completion_tenure',
        'category',
        'date_of_birth',
        'date_of_retirement',
        'email',
        'contact_number',
        'parent_department_id',
        'place_of_posting',
        'date_of_posting',
        'record_previous_posting',
        'department_id',
        'role_id',
        'last_activity_time',
        'userid_status',
        'office_type',
        'state_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'is_deleted'
    ];

}
