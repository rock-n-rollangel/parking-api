<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CheckFactory extends Factory
{
    protected $model = Check::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'car_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomNumber(),
        ];
    }
}
