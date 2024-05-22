<?php

namespace Database\Factories;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;
class PriceFactory extends Factory
{
    protected $model = Price::class;
    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'price' => $this->faker->randomFloat(2, 10, 1000), 
            'date' => $this->faker->date(),
           // 'category_id' => $this->faker->numberBetween(1, 5) 
        ];
    }
}