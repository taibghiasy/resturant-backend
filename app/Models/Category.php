<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [ 'name' , 'image' , 'description'];

    public function menus(){
        return $this->belongsToMany(Menu::class, 'category_menu');
    }
}
