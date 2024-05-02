<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Создание ролей и разрешений
        $roleAdmin = Role::create(['name' => 'admin']);
        $permissionViewUsers = Permission::create(['name' => 'view users']);
        // Назначение разрешения роли
        $roleAdmin->givePermissionTo($permissionViewUsers);
        // Нахождение пользователя
        $adminUser = User::find(3); // Замените 1 на реальный ID пользователя
        // Назначение роли администратора пользователю
        if ($adminUser) {
            $adminUser->assignRole($roleAdmin);
        }
    }
}