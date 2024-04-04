<?php

namespace App\Services\Payment\Gateways;

class PaymeGateway implements PaymentGateway
{
    public function processPayment()
    {
        app('log')->debug('Payme payment processed');
        return true;
    }
}
