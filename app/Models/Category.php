<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    use HasFactory;
    
    protected $fillable = ['name', 'parent_id'];
    // Родительская категория
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    // Дочерние категории
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // В Product.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function prices()
    {
        return $this->hasMany(Price::class);
    }    
    
    
}
