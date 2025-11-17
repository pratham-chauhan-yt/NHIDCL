<?php

namespace App\Models\DirectoryManagement;

use App\Models\RefState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclDosExternalEmployee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_dos_external_employee';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'designation',
        'department',
        'company_name',
        'ref_state_master_id',
        'address',
        'is_active',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function state()
    {
        return $this->belongsTo(RefState::class, 'ref_state_master_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
