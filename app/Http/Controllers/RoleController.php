<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission;
use App\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = SpatieRole::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
  san  {
        $this->authorize('create role', SpatieRole::class);
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Включаем поле 'actions' непосредственно в запрос create
        $role = SpatieRole::create([
            'name' => $request->name,
            'actions' => 'По умолчанию' // Установить значение поля 'actions' при создании
        ]);
        $role->syncPermissions($request->permissions);
        $this->authorize('update', $role);
        return redirect()->route('roles.index')->with('success', 'Роль создана успешно.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $role = SpatieRole::findById($id);
        $this->authorize('edit role', $role);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
        
    }

    // Обновление роли в базе данных
    public function update(Request $request, $id)
    {
        $role = SpatieRole::findById($id);
        $this->authorize('edit role', $role);
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'sometimes|array',
        ]);

        $role->name = $validatedData['name'];
        $role->save();

        $role->syncPermissions($validatedData['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Роль и разрешения обновлены успешно.');
        
    }

    // Удаление роли
    public function destroy($id)
    {
//        $role = Role::findById($id);
//        $this->authorize('delete role', $role);
//        if ($role) {
//            $role->delete();
//        }

        $role = Role::findOrFail($id); // Находим пользователя по идентификатору
        $role->delete(); // Удаляем пользователя
        return redirect()->route('roles.index')->with('success', 'Роль удалена успешно.');
        
        
        
    }    
}