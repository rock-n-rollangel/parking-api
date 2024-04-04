<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Car;
use App\Models\Tariffication;
use App\Services\Payment\PaymeFactory;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function payWithPayme(Car $car)
    {
        if ($car->check) {
            throw ValidationException::withMessages([
                'payment' => ['Parking already payed']
            ]);
        }

        if (!$car->left_at || !$car->entered_at) {
            throw ValidationException::withMessages([
                'car' => ['Car has not been entered or not left yet']
            ]);
        }

        $factory = new PaymeFactory();
        if ($factory->createPaymentGateway()->processPayment()) {
            $car->check()->create([
                'amount' => Tariffication::calcAmount($car)
            ]);
        }
    }
}
