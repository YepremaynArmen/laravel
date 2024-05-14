<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Отображение списка фотографий
    public function index(Request $request)
    {
        // Получаем параметры сортировки и фильтрации из запроса
        $sortField = $request->get('sort', 'created_at'); // По умолчанию сортируем по дате создания
        $sortDirection = $request->get('direction', 'desc'); // По умолчанию сортировка по убыванию

        // Пример фильтрации по категории, если она передана
        $category = $request->get('category');

        // Получаем список фотографий с учетом сортировки и фильтрации
        // Добавьте ->where('category', $category) если необходима фильтрация по категории и параметр category присутствует в запросе
        $photos = Photo::when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(10); // Используйте пагинацию, чтобы отображать по 10 элементов на странице

        // Возвращаем представление с передачей в него списка фотографий
        return view('photos.index', compact('photos'));
    }


    // Показ формы для создания новой фотографии
    public function create()
    {
        $files = Storage::files('public/uploads');
        // Передаем список файлов в представление
        return view('photos.create', compact('files'));
    }

    // Сохранение новой фотографии в базе данных
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
        ]);
        $imagePath = $request->file('image')->store('photos', 'public');
        $photo = new Photo([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);
        $photo->save();
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
        return view('photos.edit', compact('photo'));
    }

    // Обновление фотографии в базе данных
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required',
            // Другие правила валидации
        ]);

        $photo->update($request->all());
        return redirect()->route('photos.index')->with('success', 'Фотография успешно обновлена.');
    }

    // Удаление фотографии
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Фотография успешно удалена.');
    }
}
