<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_login()
    {
        User::create([
            'name' => 'Web User',
            'email' => 'user@example.com',
            'password' => '$2y$04$aSQzIiK98Ak2Qb6AyQbqOOUOIj6qYG4946D4Nc4pb8hjgEloXUe8C', // user@example.com
        ]);

        $input = [
            'email' => 'user@example.com',
            'password' => 'user@example.com',
        ];

        $response = $this->post('/api/sessions', $input)->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        User::create([
            'name' => 'Web User',
            'email' => 'user@example.com',
            'password' => '$2y$04$aSQzIiK98Ak2Qb6AyQbqOOUOIj6qYG4946D4Nc4pb8hjgEloXUe8C', // user@example.com
        ]);

        $input = [
            'email' => 'user@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/api/sessions', $input)->assertStatus(422);
    }
}
