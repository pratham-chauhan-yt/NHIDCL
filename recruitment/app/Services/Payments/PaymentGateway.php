<?php

namespace App\Services\Payments;

use App\Services\Payments\IciciService;

class PaymentGateway
{
    protected array $drivers;
    protected string $default;

    public function __construct()
    {
        $this->drivers = config('payment.drivers');

        $this->default = config('payment.default', 'icici');
    }

    public function  pay(string $orderId, $amount, $mobile, array $options = [])
    {

        $driver = $driver ?? $this->default;

        $client = $this->resolve($driver);


        if (!$client) {
            return ['ok' => false, 'id' => null, 'raw' => ['error' => "Driver '$driver' not found"]];
        }


        return $client->pay($orderId, $amount, $mobile, $options);
    }

    protected function resolve(string $driver)
    {

        $cfg = $this->drivers[$driver] ?? null;

        if (!$cfg) return null;

        return match ($driver) {
            'icici' => new IciciService($cfg),
            default => null,
        };
    }
}
