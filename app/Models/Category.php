<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
}
