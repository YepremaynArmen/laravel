<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'birthdate',
        'create_date',
        'login',
        'password'
        // Добавьте новые поля здесь
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
}