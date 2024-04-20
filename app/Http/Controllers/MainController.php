<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MainController extends Controller
{
    public function index()
    {
        return view('new_index'); // Предполагается, что файл index.blade.php находится в resources/views/new_index.blade.php
    }
    public function contacts()
    {
        return view('contacts'); // Предполагается, что файл index.blade.php находится в resources/views/new_index.blade.php
    }    
}