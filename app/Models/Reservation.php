<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'tel_number',
        'email',
        'table_id',
        'res_date',
        'res_start_time',
        'res_end_time',
        'guest_number',
        'status',
        'expired',
    ];

    protected $casts = [
        'res_date' => 'date:Y-m-d',
        'res_start_time' => 'string',
        'res_end_time' => 'string',
        'expired' => 'boolean',
    ];

    public function table()
    {
        return $this->belongsTo(\App\Models\Table::class, 'table_id');
    }

    public function isActive()
    {
        // treat Pending as active (you can update logic if you rename statuses)
        return ($this->status === 'Pending') && !$this->expired;
    }
}
