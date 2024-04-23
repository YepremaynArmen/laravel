<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail; // Это ваш класс Mailable, который описывает письмо

class MainController extends Controller
{
    public function index()
    {
        return view('new_index'); // Предполагается, что файл index.blade.php находится в resources/views/new_index.blade.php
    }
    public function contacts()
    {
        return view('contacts'); // Предполагается, что файл index.blade.php находится в resources/views/contacts.blade.php
    }    
   public function about()
    {
        return view('about'); // Предполагается, что файл index.blade.php находится в resources/views/about.blade.php
    }        
    
    public function send(Request $request)
    {
        // Валидация данных формы
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
        'subject' => 'required|max:255',
        'message' => 'required'
    ]);
    try {
        // Создание письма с использованием Mailable класса
        $email = new ContactMail($validatedData);
        // Отправка письма
       // Mail::to('earmen.laravel@it-schools.org')->send($email);
        Mail::to($request->input('email'))->send($email);
       \Log::info('Перенаправление с сообщением об успехе.');
        return redirect()->back()->with('success', 'Ваше сообщение было успешно отправлено.');
    } catch (\Exception $e) {
        // Запись исключения в лог
        \Log::error('Ошибка при отправке письма: '.$e->getMessage());
        // Перенаправление обратно с сообщением об ошибке
        return redirect()->back()->with('error', 'Произошла ошибка при отправке вашего сообщения.');
    }
    }
}