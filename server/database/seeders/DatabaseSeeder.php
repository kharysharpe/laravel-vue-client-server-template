<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name' => 'Web User',
            'email' => 'user@example.com',
            'password' => '$2y$04$aSQzIiK98Ak2Qb6AyQbqOOUOIj6qYG4946D4Nc4pb8hjgEloXUe8C', // user@example.com
        ]);

        $this->call([
            ThingSeeder::class,
        ]);
    }
}
