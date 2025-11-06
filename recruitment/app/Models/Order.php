<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_orders_payment_details';

    protected $fillable = [
        'response_code',
        'transaction_id',
        'entity_id',
        'payment_mode',
        'ref_no',
        'total_amount',
        'transaction_amount',
        'transaction_date',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
