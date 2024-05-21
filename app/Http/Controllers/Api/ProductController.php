<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    // Получение списка всех продуктов
    public function index()
    {
        $products = Product::all(); // Получаем все товары
        $date = now()->toDateString(); // Используем сегодняшнюю дату для получения цены
        foreach ($products as $product) {
            // Делаем запрос к API для каждого товара, чтобы получить актуальную цену
            $response = Http::get("http:/localhost:8080/api/prices/{$product->id}?date={$date}");
            if ($response->successful()) {
                // Если запрос успешен, добавляем цену к информации о товаре
                $priceData = $response->json();
                $product->current_price = $priceData['price'];
                $product->current_price_date = $priceData['date'];
            } else {
                // Если запрос не успешен, добавляем null или некое значение по умолчанию
                $product->current_price = null;
            }
        }
        // Передаем товары с ценами в представление
        return view('products.index', compact('products'));
    
    }
        // В файле app/Http/Controllers/ProductController.php
     public function create()
     {
         // Предполагается, что у вас есть модель Category для выбора категорий
         $categories = Category::all();
         return view('products.create', compact('categories'));
     }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id'
        ]);
        $product = Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен.');
    }     
     
    public function edit($id)
    {
        $product = Product::with(['prices' => function ($query) {
            $query->orderBy('date', 'asc'); // Сортировка по дате в порядке убывания
        }])->findOrFail($id);
        // Загрузка категорий, если они нужны для выпадающего списка
        $categories = Category::all();
        // Передача данных в представление
        return view('products.edit', compact('product', 'categories'));
    }

     
     public function update(Request $request, Product $product)
     {
         $validatedData = $request->validate([
             'name' => 'required|max:255',
             'description' => 'nullable',
             'category_id' => 'required|exists:categories,id'
         ]);
         $product->update($validatedData);
         return redirect()->route('products.index')->with('success', 'Товар успешно обновлен.');
     }
     public function destroy(Product $product)
     {
         $product->delete();
         return redirect()->route('products.index')->with('success', 'Товар удален.');
     }
}