<?php

namespace Database\Seeders;

use App\Models\Thing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thing::create([
            'name' => 'Test One'
        ]);

        Thing::create([
            'name' => 'Test Two'
        ]);

        Thing::create([
            'name' => 'Test Three'
        ]);
    }
}
