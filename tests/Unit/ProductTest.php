<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Price;

class ProductControllerTest extends TestCase
{
    //use RefreshDatabase;

    public function testGetCurrentPrice()
    {
        // Создаем продукт
        $product = Product::factory()->create();

        // Создаем цену для продукта
        $price = Price::factory()->create([
            'product_id' => $product->id,
            'price' => 99.99,
            'date' => now(),
        ]);

        // Отправляем запрос к методу контроллера.
        $response = $this->json('GET', "api/products/{$product->id}/current-price");

        // Проверяем статус ответа.
        $response->assertStatus(200);

        // Проверяем, содержит ли ответ ожидаемую структуру данных.
        $response->assertJson([
            'price' => $price->price,
        ]);
    }
}
