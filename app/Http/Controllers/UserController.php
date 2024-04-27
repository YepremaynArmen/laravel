<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Проверка доступа к странице
        if (Gate::denies('view-users-page', auth()->user())) {
            abort(403);
        }
        // Получение списка пользователей и отображение страницы
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация входных данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        // Попытка сохранения пользователя в базу данных
        $user = new User;
        $user->name = $validatedData['name'];
        $user->birthdate = $validatedData['birthdate'];
        $user->login = $validatedData['login'];
        $user->password = Hash::make($validatedData['password']); // Хеширование пароля перед сохранением
        $user->save(); // Сохранение пользователя в базу данных
        // Перенаправление на страницу со списком пользователей с сообщением об успешном добавлении
        return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::findOrFail($id);
       return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Находим пользователя по идентификатору
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'birthdate' => 'required|date',
            'login' => 'required|unique:users,login,' . $user->id,
            'password' => 'sometimes|nullable|min:8',
        ]);
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'Данные пользователя успешно обновлены.');
    }
    

    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Находим пользователя по идентификатору
        $user->delete(); // Удаляем пользователя
        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален.');
    }
}
