<?php

namespace App\Services\Payment;

use App\Services\Payment\Gateways\PaymentGateway;

abstract class PaymentFactory
{
    abstract public function createPaymentGateway(): PaymentGateway;
}
