<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'nhidcl_payment_histories';

    public $timestamps = false;

    protected $fillable = [
        'response_code',
        'nhidcl_orders_payment_details_id',
        'ref_no',
        'response_body',
    ];
}
