<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class PhotoController extends Controller
{
    // Отображение списка фотографий
    
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $category = $request->get('category');
        // Получаем список фотографий с учетом сортировки и фильтрации
        $photos = Photo::with('category') // Жадная загрузка категорий
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(10); // Пагинация
        return view('photos.index', compact('photos'));
    }    


    // Показ формы для создания новой фотографии
    public function create()
    {
        $files = Storage::files('public/uploads');
        $files = array_map(function ($file) {
            return basename($file);
        }, $files);
        $categories = Category::all(); // Получаем список всех категорий
        return view('photos.create', compact('files', 'categories')); // Передаем список файлов и категорий в представление
    }

    // Сохранение новой фотографии в базе данных
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Правило валидации для названия
            'description' => 'nullable|string', // Описание может быть пустым
            'image' => 'required|image', // Загружаемый файл должен быть изображением
            'category_id' => 'nullable|exists:categories,id', // Категория не обязательна, но если указана, должна существовать
        ]);
        // Обработка загрузки файла
        $imagePath = $request->file('image')->store('public/uploads');
        $imagePath = basename($imagePath); // Получаем только имя файла для сохранения в базе данных
        // Создание новой фотографии в базе данных
        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('photos.index')->with('success', 'Фотография успешно добавлена.');
    }
    // Отображение конкретной фотографии
    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }

    // Показ формы для редактирования фотографии
    public function edit(Photo $photo)
    {
        $categories = Category::all(); // Получаем список всех категорий для dropdown
        return view('photos.edit', compact('photo', 'categories'));
    }

    // Обновление фотографии в базе данных
   public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image', // Загружаемый файл должен быть изображением

        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/uploads');
            $imagePath = basename($path); // Получаем только имя файла
           
            $dataToUpdate = [
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image_path' => $imagePath,
            ];
            $photo->update($dataToUpdate);
        }
       
        return redirect()->route('photos.index')->with('success', 'Фотография успешно обновлена.');
    }
    
    // Удаление фотографии
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Фотография успешно удалена.');
    }
}
