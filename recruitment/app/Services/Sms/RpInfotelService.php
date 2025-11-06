<?php

namespace App\Services\Sms;

use App\Services\Sms\SmsClient;
use GuzzleHttp\Client;
use Exception;

class RpInfotelService implements SmsClient
{
    protected Client $http;
    protected array $cfg;

    public function __construct(array $cfg)
    {
        $this->cfg = $cfg;

        $this->http = new Client([
            'base_uri' => rtrim($this->cfg['base_uri'] ?? '', '/') . '/',
            'timeout'  => 10,
        ]);
    }

    public function send(string $to, string $message, array $options = []): array
    {
        try {
            $entityId   = $options['entityId']   ?? null;
            $templateId = $options['templateId'] ?? null;

            $params = [
                'username'  => $this->cfg['username'],
                'dest'      => $to,
                'apikey'    => $this->cfg['apikey'],
                'signature' => $this->cfg['signature'],
                'msgtype'   => $options['msgtype'] ?? 'PM',
                'msgtxt'    => $message,
            ];

            if ($entityId) {
                $params['entityid'] = $entityId;
            }

            if ($templateId) {
                $params['templateid'] = $templateId;
            }

            $queryString = http_build_query($params);

            $response = $this->http->get('sendmsg', [
                'query' => $params,
                'verify'   => false,
            ]);

            return [
                'ok'   => $response->getStatusCode() === 200,
                'body' => (string) $response->getBody(),
            ];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 500);
        }
    }
}
