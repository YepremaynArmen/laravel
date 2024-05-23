<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    function renderCategories($categories, $level = 0) {
        foreach ($categories as $category) {
            echo '<tr>' .
                 '<td>' . str_repeat('—', $level) . ' ' . $category->name . '</td>' .
                 '<td> // Действия для категории </td>' .
                 '</tr>';
            if (count($category->children) > 0) {
                renderCategories($category->children, $level + 1);
            }
        }
    }    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
// В CategoryController.php
    public function create()
    {
        // Получаем все категории с их дочерними элементами
        $categories = Category::with('children')->whereNull('parent_id')->get();
        // Вызываем метод для построения иерархического списка
        $categoryList = $this->buildCategoryList($categories);
        // Передаем список в представление
        return view('categories.create', compact('categoryList'));
    }
    // Рекурсивный метод для построения списка
    private function buildCategoryList($categories, $prefix = '')
    {
        $result = [];
        foreach ($categories as $category) {
            $result[$category->id] = $prefix . $category->name;
            if ($category->children->isNotEmpty()) {
                $result += $this->buildCategoryList($category->children, $prefix . '--');
            }
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $category = new Category(['name' => $request->name, 'parent_id' => $request->parent_id]);
        $category->save();
        if ($request->wantsJson()) {
            return response()->json(category, 201);
        }          
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // В CategoryController.php
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get(); // Исключите текущую категорию из списка
        return view('categories.edit', compact('category', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required',
            // Другие правила валидации
        ]);
        $category->update($request->all()); // Обновляем категорию
        return redirect()->route('categories.index')->with('success', 'Категория обновлена успешно');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // Удаляем категорию
        return redirect()->route('categories.index')->with('success', 'Категория удалена успешно');
    }
}
