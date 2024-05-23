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
        // Проверяем, ожидает ли клиент JSON-ответ (API-запрос)
        if ($request->wantsJson()) {
            return response()->json($product, 201);
        }
        // Для веб-запросов выполняем редирект
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
     
     
    public function getCurrentPrice($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $currentPrice = $product->prices()->orderBy('date', 'desc')->first();

        if ($currentPrice) {
            return response()->json([
                'price' => $currentPrice->price,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Price not found',
            ], 404);
        }
    }
    
    
    public function getPriceOnDate(Product $product, Request $request)
    {
        // Получаем дату из query-параметра 'date'
        $date = $request->query('date');
        // Проверяем, что дата была передана
        if (!$date) {
            return response()->json(['error' => 'No date provided'], 400);
        }
        // Ищем цену для продукта, которая актуальна на переданную дату
        $price = $product->prices()
                         ->where('date', '<=', $date)
                         ->orderBy('date', 'desc')
                         ->first();
        // Если цена найдена, возвращаем ее, иначе возвращаем ошибку
        if ($price) {
            return response()->json(['price' => $price->price]);
        } else {
            return response()->json(['error' => 'Price not found for the specified date'], 404);
        }
    }   
 

    public function show(Product $product)
    {
        // Предполагаем, что у Product есть связь с Price через метод prices()
        $latestPrice = $product->prices()->latest('date')->first();
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'latest_price' => $latestPrice ? $latestPrice->price : null
        ]);
    }
    
}