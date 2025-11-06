<?php

namespace App\Services\Sms;

interface SmsClient
{
    /**
     * @param string $to E.164 format (e.g., +9198XXXXXXXX)
     * @param string $message Text content (GSM-7/Unicode)
     * @param array  $options ['sender_id' => '...', 'type' => 'transactional|promotional', ...]
     * @return array ['ok' => bool, 'id' => string|null, 'raw' => mixed]
     */
    public function send(string $to, string $message, array $options = []): array;
}
