<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhidclResourceAdvertisementCommitte extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nhidcl_resource_advertisement_committe';

    protected $fillable = [
        'nhidcl_resource_requisition_id',
        'ref_committe_id',
    ];

    
}
