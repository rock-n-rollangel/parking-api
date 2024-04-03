<?php

namespace Database\Factories;

use App\Models\Tariffication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TarifficationFactory extends Factory
{
    protected $model = Tariffication::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'price' => $this->faker->randomNumber(),
        ];
    }
}
