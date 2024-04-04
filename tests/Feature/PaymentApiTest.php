<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\ParkingSpace;

class PaymentApiTest extends BaseTest
{
    public function test_car_pay_success()
    {
        $car = Car::create([
            'number' => '01 b007ar',
            'entered_at' => now()->subHour(),
            'left_at' => now(),
            'parking_space_id' => ParkingSpace::whereState(true)->first()->id,
        ]);

        $this->post(route('payments.pay-with-payme', ['car' => $car->id]))
            ->assertStatus(200);
    }

    public function test_car_pay_fail()
    {
        $car = Car::whereLeftAt(null)
            ->first();

        $this->post(route('payments.pay-with-payme', ['car' => $car->id]))
            ->assertJsonValidationErrorFor('car');
    }
}
