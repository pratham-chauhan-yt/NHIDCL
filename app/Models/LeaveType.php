<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory;

    use SoftDeletes;
    public $timestamps = false;

    protected $table = 'ref_leave_type';

    protected $fillable = [
        "leave_type",
        "created_at",
        "created_by",
        "is_deleted",
        'updated_by',
    ];

}
