<?php

namespace Tests\Feature;

use App\Helpers\TimeHelper;
use App\Models\ParkingSpace;
use App\Models\Tariffication;

class TarifficationApiTest extends BaseTest
{
    public function test_fail_update_time_allocated()
    {
            $tariffication = Tariffication::whereDefault(false)->first();
            $data = [
                'active_from' => '03:00',
                'active_to' => '11:00',
                'price' => 500,
            ];

            $response = $this
                ->put(
                    route(
                        'tariffications.update',
                        ['tariffication' => $tariffication->id]
                    ),
                    $data
                );
            $response->assertJsonValidationErrorFor('active_from')
                ->assertJsonValidationErrorFor('active_to');
    }

    public function test_fail_update_slice_parts_wrong()
    {
        $tariffication = Tariffication::whereDefault(false)->first();
        $data = [
            'active_from' => '20:00',
            'active_to' => '20:00',
            'price' => 500,
        ];
        $response = $this
            ->put(
                route(
                    'tariffications.update',
                    ['tariffication' => $tariffication->id]
                ),
                $data
            );
        $response->assertJsonValidationErrorFor('active_from')
            ->assertJsonValidationErrorFor('active_to');
    }

    public function test_amount_correct()
    {
        Tariffication::truncate();
        $tariffs_data = [
            [
                'price' => 150,
                'default' => true,
            ],
            [
                'price' => 100,
                'active_from' => 0,
                'active_to' => 3600,
            ],
            [
                'price' => 50,
                'active_from' => 3601,
                'active_to' => 7200,
            ]
        ];

        $amount = 0;
        foreach ($tariffs_data as $tariff_data) {
            Tariffication::create($tariff_data);
            $amount += $tariff_data['price'];
        }

        $parking_space = ParkingSpace::whereState(true)->first();
        $car = $parking_space->car()->create([
            'number' => '01 B123AR',
            'entered_at' => now()->startOfDay(),
            'left_at' => now()->startOfDay()->addHours(3),
        ]);

        $this->assertEquals($amount, Tariffication::calcAmount($car));
    }
}
