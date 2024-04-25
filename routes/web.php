<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MyFormController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Ресурсный маршрут для пользователей, включает маршруты для CRUD операций
Route::resource('users', UserController::class);


Route::get('/new_index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/contacts', [MainController::class, 'contacts']);
Route::post('/contacts', [MainController::class, 'send'])->name('contacts.send');
Route::get('/myform', [MyFormController::class, 'showForm'])->name('myform.show');
Route::post('/myform', [MyFormController::class, 'submit'])->name('myform.submit');
Route::get('/success-page', function () {return view('success');})->name('success.page');

Route::get('/login', function () {return view('auth.login');})->middleware('guest')->name('login');
Route::get('/register', function () {return view('auth.register');})->middleware('guest')->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Маршрут для обработки запроса на вход
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');

//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');
//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');