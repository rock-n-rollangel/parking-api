<?php

namespace Database\Seeders;

use App\Models\Tariffication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tariffication::factory()->create([
            'price' => 500,
            'default' => true,
        ]);

        Tariffication::factory()->create([
            'active_from' => '00:00',
            'active_to' => '08:00',
            'price' => 1000,
        ]);

        Tariffication::factory()->create([
            'active_from' => '08:01',
            'active_to' => '12:00',
            'price' => 2500,
        ]);

        Tariffication::factory()->create([
            'active_from' => '12:01',
            'active_to' => '15:00',
            'price' => 5000,
        ]);

        Tariffication::factory()->create([
            'active_from' => '15:01',
            'active_to' => '18:00',
            'price' => 3000,
        ]);

        Tariffication::factory()->create([
            'active_from' => '18:01',
            'active_to' => '21:00',
            'price' => 1500,
        ]);
    }
}
