<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'parent_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}