<?php

namespace App\Services\Payment\Gateways;

interface PaymentGateway
{
    public function processPayment();
}
