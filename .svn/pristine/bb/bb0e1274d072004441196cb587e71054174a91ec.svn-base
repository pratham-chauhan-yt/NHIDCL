<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RefStatus;

class NhidclClaimExpenses extends Model
{
    use HasFactory;
    protected $table = 'nhidcl_ems_claim_expense_details';
    protected $guarded = [];

    protected $fillable = [
        "ref_users_id",
        "purpose",
        "amount",
        "from_date",
        "to_date",
        "description",
        "payment_proof",
        "claim_date",
        "ref_status_id",
        "created_by",
        "updated_by",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,"ref_users_id")->select('id', 'name', 'email');
    }

    public function status(){
        return $this->belongsTo(RefStatus::class,"ref_status_id")->select('id', 'type');
    }
}