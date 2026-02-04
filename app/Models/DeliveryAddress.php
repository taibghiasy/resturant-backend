<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    protected $fillable = [
        'order_id',
        'district',
        'street',
        'house_number',
        'notes',
        'delivery_time'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
