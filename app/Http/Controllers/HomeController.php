<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }
    public function index()
    {
        return view('home'); // Return the home view
    }
}