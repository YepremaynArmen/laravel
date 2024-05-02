<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Contracts\Auth\Authenticatable;
//use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
//use Illuminate\Notifications\Notifiable; 
//use Spatie\Permission\Traits\HasRoles;
//class User extends Model implements Authenticatable

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Наследуйтесь от Authenticatable
{
    //use AuthenticatableTrait, HasFactory, Notifiable, HasRoles;
    use HasFactory, Notifiable, HasRoles;
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
    
//    public function roles()
//    {
//        return $this->belongsToMany(Role::class, 'user_roles');
//    }
}