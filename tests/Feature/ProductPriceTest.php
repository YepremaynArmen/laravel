<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Price;
use App\Models\Category;

class ProductPriceTest extends TestCase
{
    //use RefreshDatabase;
    public function test_product_price_retrieval()
    {
        // Создаем продукт и устанавливаем его цену
        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
            'price' => 150.00,
            'date' => now()->toDateString(),
        ]);
        // Отправляем запрос для получения информации о продукте
        $response = $this->get("/api/products/{$product->id}");
        // Проверяем статус ответа и содержание
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $product->id,
            'latest_price' => $price->price,
        ]);
    }
    public function test_adding_new_product_with_price()
    {
        // Данные для создания нового продукта
        $category = Category::factory()->create();
        $productData = [
            'name' => 'New Product',
            'description' => 'This is a new product.',
            'category_id' => $category->id // Используем ID только что созданной категории
        ];
        // Отправляем запрос на создание нового продукта
        $response = $this->postJson('/api/products', $productData);
        // Проверяем статус ответа и содержание
        $response->assertStatus(201);
        $responseData = $response->json();
        $productId = $responseData['id'];
        // Данные для установки цены продукта
        $priceData = [
            'price' => 199.99,
            'date' => now()->toDateString(), // Получаем текущую дату в формате 'Y-m-d'
            'product_id' => $productId // ID нового продукта
        ];
        // Отправляем запрос на создание цены для продукта
        $response = $this->postJson('/api/prices', $priceData);
        // Проверяем статус ответа и содержание для цены
        $response->assertStatus(201);
        $response->assertJson([
            'product_id' => $productId,
            'price' => $priceData['price'],
            'date' => $priceData['date']
        ]);
        // Проверяем, была ли цена действительно добавлена в базу данных
        $this->assertDatabaseHas('prices', [
            'product_id' => $productId,
            'price' => $priceData['price'],
            'date' => $priceData['date']
        ]);
    }
}