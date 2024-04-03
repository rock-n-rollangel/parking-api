<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'number' => $this->faker->word(),
            'entered_at' => Carbon::now(),
            'left_at' => Carbon::now(),
        ];
    }
}
