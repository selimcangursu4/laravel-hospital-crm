<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'customer_id',
        'service_id',
        'service_price',
        'discount',
        'final_price',
        'payment_status',
        'user_id',
    ];
}
