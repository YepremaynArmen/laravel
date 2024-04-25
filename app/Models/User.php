<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class User extends Model implements Authenticatable
{
    use AuthenticatableTrait, HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'birthdate',
        'create_date',
        'login',
        'password',
        'email'
        // Добавьте новые поля здесь
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
}