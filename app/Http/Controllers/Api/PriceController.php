<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'price' => 'required|numeric',
        'date' => 'required|date'
        ]);
        // Создаем цену и сохраняем созданный экземпляр в переменной $price
        $price = Price::create($validatedData);
        // Проверяем, что запрос ожидает JSON ответ
        if ($request->wantsJson()) {
            return response()->json($price, 201); // Возвращаем $price, который содержит данные о цене
        }
        // Для не-API запросов выполняем редирект
        return redirect()->route('products.edit', $validatedData['product_id'])->with('success', 'Цена успешно добавлена.');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $productId = $price->product_id;
        $price->delete();
        return redirect()->route('products.edit', $productId)->with('success', 'Цена удалена.');
    }
}
