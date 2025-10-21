<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $fillable = ['name', 'description', 'image'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'cat_men', 'category_id', 'menu_id');
    }
}
