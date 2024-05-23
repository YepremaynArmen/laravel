<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition()
    {
        return [
            // Укажите здесь атрибуты для вашей модели 'Category'
            'name' => $this->faker->word,
            // Другие атрибуты...
        ];
    }
}
