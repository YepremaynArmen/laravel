<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Отображение списка разрешений
    public function index()
    {
        $permissions = Permission::all(); // Получение всех разрешений
        return view('permissions.index', compact('permissions'));
    }

    // Форма для создания нового разрешения
    public function create()
    {
        return view('permissions.create');
    }

    // Сохранение нового разрешения в базу данных
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:permissions'
        ]);

        $permission = Permission::create(['name' => $validatedData['name']]);

        return redirect()->route('permissions.index')->with('success', 'Разрешение создано успешно.');
    }

    // Форма для редактирования существующего разрешения
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    // Обновление разрешения в базе данных
    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:permissions,name,' . $permission->id
        ]);

        $permission->update(['name' => $validatedData['name']]);

        return redirect()->route('permissions.index')->with('success', 'Разрешение обновлено успешно.');
    }

    // Удаление разрешения
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Разрешение удалено успешно.');
    }
}
