<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        // Получаем данные пользователя из сессии
        $userId = $request->session()->get('user_id');
        $roles = $request->session()->get('roles');
        // Передаем данные в представление
        return view('users.profile', compact('userId', 'roles'));
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }    
    
}