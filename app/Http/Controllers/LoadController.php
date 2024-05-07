<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoadController extends Controller
{
    public function index()
    {
        return view('loads.index'); // Возвращает представление страницы 'loads'
    }
    
    public function upload(Request $request) 
    {
        if ($request->hasFile('file')) 
        { 
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Загрузка файла в диск 'public' 
            $path = $file->storeAs('uploads', $filename, 'public');
            // Если файл успешно загружен, возвращаем ответ с путём к файлу 
            if($path) { 
                return back()->with('success', 'Файл успешно загружен')->with('file', $filename);
            } 
            return back()->with('error', 'Ошибка при загрузке файла');
        } 
        return back()->with('error', 'Файл не выбран');
    }    
}
