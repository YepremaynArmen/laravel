<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MyFormController extends Controller
{
    // Метод для отображения формы
    public function showForm()
    {
        return view('myform');
    }
    // Метод для обработки данных формы
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
        'my_field' => 'customrule'
    ]);
    // Действия после валидации...
    // Вернуть пользователя на определенную страницу или показать представление
    return redirect('/success-page')->with('message', 'Form submitted successfully!');
    }
}