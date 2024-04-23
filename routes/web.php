<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
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