<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Получение списка всех продуктов
    public function index()
    {
        $products = Product::all();
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
        $product = Product::with('prices')->findOrFail($id);
        // Загрузка категорий, если они нужны для выпадающего списка
        $categories = Category::all();
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