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
    
    public function test_get_price_on_specific_date()
    {
        $product = Product::factory()->create();
        $price1 = Price::factory()->create([
            'product_id' => $product->id,
            'price' => 99.99,
            'date' => '2024-01-01'
        ]);
        $price2 = Price::factory()->create([
            'product_id' => $product->id,
            'price' => 100.00,
            'date' => '2024-01-10'
        ]);
        $price3 = Price::factory()->create([
            'product_id' => $product->id,
            'price' => 110.00,
            'date' => '2024-01-21'
        ]);
        $response = $this->get("/api/products/{$product->id}/price-on-date?date=2024-01-05");
        // Проверяем, что ответ содержит статус код 200
        $response->assertStatus(200);
        // Проверяем, что ответ содержит правильную цену
        $response->assertJson([
            'price' => 99.99
        ]);        
    }    
    
}
