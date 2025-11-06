<?php

namespace App\Services\Sms;

use App\Services\Sms\RpInfotelService;

class SmsGateway
{
    protected array $drivers;
    protected string $default;

    public function __construct()
    {
        $this->drivers = config('sms.drivers');

        $this->default = config('sms.default', 'rp_info_tel');
    }

    public function  send(string $to, string $message, array $options = []): array
    {

        $driver = $driver ?? $this->default;

        $client = $this->resolve($driver);
        if (!$client) {
            return ['ok' => false, 'id' => null, 'raw' => ['error' => "Driver '$driver' not found"]];
        }

        return $client->send($to, $message, $options);
    }

    protected function resolve(string $driver): ?SmsClient
    {
        $cfg = $this->drivers[$driver] ?? null;
        if (!$cfg) return null;

        return match ($driver) {
            'rp_info_tel' => new RpInfotelService($cfg),
            default => null,
        };
    }
}
