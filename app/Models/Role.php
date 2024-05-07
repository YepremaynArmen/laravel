<?php

namespace App\Models;

namespace App\Models;
use Spatie\Permission\Models\Role as SpatieRole;
class Role extends SpatieRole
{
//    use HasFactory, HasRoles;
    protected $attributes = [
        'actions' => 'По умолчанию', // Значение по умолчанию для поля actions
    ];    
    
    
//    public function users()
//    {
//        return $this->belongsToMany(User::class, 'user_roles');
//    }    
    
}
