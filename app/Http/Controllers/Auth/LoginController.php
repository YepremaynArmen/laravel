<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Убедитесь, что используете этот класс
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function create()
    {
        return view('auth.login');
    }
    
    
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Сохраняем данные пользователя в сессию
        session([
            'user_id' => $user->id,
            'roles' => $user->roles()->pluck('name')->toArray(), // Предполагается, что у модели User есть метод roles()
        ]);
        // Здесь вы также можете добавить любую другую логику, которая должна выполняться после аутентификации пользователя
    }    
    
    
}
