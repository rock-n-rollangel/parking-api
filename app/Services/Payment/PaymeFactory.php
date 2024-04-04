<?php

namespace App\Services\Payment;

use App\Services\Payment\Gateways\PaymeGateway;
use App\Services\Payment\Gateways\PaymentGateway;

class PaymeFactory extends PaymentFactory
{
    public function createPaymentGateway(): PaymentGateway
    {
        return new PaymeGateway();
    }
}
