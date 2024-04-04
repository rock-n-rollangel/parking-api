<?php

namespace Database\Seeders;

use App\Helpers\TimeHelper;
use App\Models\Car;
use App\Models\Check;
use App\Models\ParkingSpace;
use App\Models\Tariffication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Builder;
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
            'active_from' => TimeHelper::getSecondsFromTime('00:00'),
            'active_to' => TimeHelper::getSecondsFromTime('08:00'),
            'price' => 1000,
        ]);

        Tariffication::factory()->create([
            'active_from' => TimeHelper::getSecondsFromTime('08:01'),
            'active_to' => TimeHelper::getSecondsFromTime('12:00'),
            'price' => 2500,
        ]);

        Tariffication::factory()->create([
            'active_from' => TimeHelper::getSecondsFromTime('12:01'),
            'active_to' => TimeHelper::getSecondsFromTime('15:00'),
            'price' => 5000,
        ]);

        Tariffication::factory()->create([
            'active_from' => TimeHelper::getSecondsFromTime('15:01'),
            'active_to' => TimeHelper::getSecondsFromTime('18:00'),
            'price' => 3000,
        ]);

        Tariffication::factory()->create([
            'active_from' => TimeHelper::getSecondsFromTime('18:01'),
            'active_to' => TimeHelper::getSecondsFromTime('21:00'),
            'price' => 1500,
        ]);

        $layers = ['A', 'B', 'C'];
        $places = [1, 2, 3, 4, 5];

        foreach ($layers as $layer) {
            foreach ($places as $place) {
                if ($place % 2 === 0) {
                    ParkingSpace::factory()
                        ->has(Car::factory([
                            'number' => "01 x" . fake()->numerify() . fake()->randomLetter() . fake()->randomLetter(),
                            'entered_at' => now()->subHours(fake()->numberBetween(2, 5)),
                            'left_at' => $place === 2 ? now() : null
                        ]))
                        ->create([
                            'state' => false,
                            'name' => "$layer$place",
                        ]);
                } else
                    ParkingSpace::factory()->create([
                        'state' => true,
                        'name' => "$layer$place",
                    ]);
            }
        }

        Car::where('entered_at', '!=', null)
            ->where('left_at', '!=', null)
            ->get()
            ->each(function (Car $car) {
                $car->check()->create([ 'amount' => Tariffication::calcAmount($car) ]);
            });

    }
}
