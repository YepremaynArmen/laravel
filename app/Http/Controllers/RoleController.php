<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create role', Role::class);
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
        
        $role = Role::create(['name' => $request->name]);
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
        $role = Role::findById($id);
        $this->authorize('edit role', $role);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
        
    }

    // Обновление роли в базе данных
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $this->authorize('update role', $role);
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
        $role = Role::findById($id);
        $this->authorize('delete role', $role);
        if ($role) {
            $role->delete();
        }

        return redirect()->route('roles.index')->with('success', 'Роль удалена успешно.');
    }    
}