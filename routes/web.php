<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MyFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PhotoController;
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
//Route::get('/about', [MainController::class, 'about'])->middleware('auth');
//Route::get('/contacts', [MainController::class, 'contacts'])->middleware('auth');


Route::post('/contacts', [MainController::class, 'send'])->name('contacts.send');
Route::get('/myform', [MyFormController::class, 'showForm'])->name('myform.show');
Route::post('/myform', [MyFormController::class, 'submit'])->name('myform.submit');
Route::get('/success-page', function () {return view('success');})->name('success.page');

//Route::get('/login', function () {return view('auth.login');})->middleware('guest')->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Маршрут для обработки запроса на вход
Route::post('/login', [LoginController::class, 'login']);
//Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');



Route::get('/register', function () {return view('auth.register');})->middleware('guest')->name('register');



//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');
//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Перенаправление с корневого URL на /home
Route::redirect('/', '/home', 301);
Route::redirect('/index', '/home', 301);        

// Даем маршруту имя используя метод name()
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('check.permissions');
//Route::get('/no-access', function () {
//    return view('no-access'); // Создайте соответствующий шаблон в resources/views/no-access.blade.php
//});

// Роли
Route::resource('roles', \App\Http\Controllers\RoleController::class);
// Разрешения
Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
Route::put('/users/{user}/assign_role', [\App\Http\Controllers\UserController::class, 'assignRole'])->name('users.assign_role');

Route::get('/loads', [LoadController::class, 'index'])->name('loads.index');
Route::post('/upload', 'App\Http\Controllers\LoadController@upload');
//Route::post('/upload', [LoadController::class, 'upload']);

Route::get('/user/profile', [UserProfileController::class, 'index'])->name('users.profile');
//Route::get('/user/profile', function () {return 'Привет';});
Route::resource('photos', PhotoController::class);
