<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignatureDish extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'price',
    ];
}
