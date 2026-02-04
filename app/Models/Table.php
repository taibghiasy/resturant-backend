<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tabels'; // keep your table name
    protected $fillable = [
        'name',
        'guest_number',
        'location',
    ];

    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class, 'table_id');
    }
}
