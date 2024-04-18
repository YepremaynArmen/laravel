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
        try {
            // Создание нового пользователя
            $user = User::create([
                'name' => $validatedData['name'],
                'birthdate' => $validatedData['birthdate'],
                'login' => $validatedData['login'],
                'password' => Hash::make($validatedData['password']),
            ]);
            // Перенаправление на страницу со списком пользователей с сообщением об успешном добавлении
            return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен.');
        } catch (QueryException $e) {
            // Вывод ошибки
            return redirect()->back()->withInput()->withErrors('Ошибка добавления пользователя: ' . $e->getMessage());
        }
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
        //
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
            'email' => 'required|email|unique:users,email,' . $user->id,
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
