<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Создаем пользователя
        $user = User::factory()->create();

        // Действуем от лица созданного пользователя
        $response = $this->actingAs($user)->get(route('users.show', $user->id));

        // Проверяем, что ответ сервера успешный (статус 200)
        $response->assertStatus(200);

        // Проверяем, что в ответе есть определенный текст (например, имя пользователя)
        // Это дополнительная проверка для удостоверения, что страница содержит ожидаемые данные
        $response->assertSee(e($user->name));
    }
}
