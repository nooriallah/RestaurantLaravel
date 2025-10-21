<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $fillable = ['name', 'slug', 'description', 'price', 'image', 'status'];

    public function getRouteKeyName()
    {
        return 'slug';
    }   
    public function categories()
    {
        return $this->belongsToMany(Category::class, "cat_men", "menu_id", "category_id");
    }
}
