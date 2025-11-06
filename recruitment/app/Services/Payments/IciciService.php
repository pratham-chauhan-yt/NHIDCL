<?php

namespace App\Services\Payments;

use Exception;
use App\Services\Payments\PaymentClient;

class IciciService implements PaymentClient
{
    protected array $cfg;

    public function __construct(array $cfg)
    {
        $this->cfg = $cfg;
    }

    public function pay($orderId, $amount, $mobile, $options = [])
    {
        try {

            $mandatoryFields = $orderId . '|' . $this->cfg['ic_submerchant_id'] . '|' . $amount . '|xyz|xyz|xyz|' . $options['email'] . '|' . $mobile . '|xyz|xyz|xyz|xyz|xyz|xyz|xyz';

            $redirect = 'sss|12s';

            $params = [
                'merchantid'         => $this->cfg['ic_id'],
                'mandatory fields'   => $this->generateEncryption($mandatoryFields),
                'optional fields'    => '', //$this->generateEncryption($redirect),
                'returnurl'          => $this->generateEncryption($this->cfg['ic_return_url']),
                'Reference No'       => $this->generateEncryption($orderId),
                'submerchantid'      => $this->generateEncryption($this->cfg['ic_submerchant_id']),
                'transaction amount' => $this->generateEncryption($amount),
                'paymode'            => $this->generateEncryption($this->cfg['ic_payment_mode']),
            ];

            // $queryString = collect($params)
            //     ->map(function ($value, $key) {
            //         return $key . '=' . $value;
            //     })
            //     ->implode('&');

            $queryString = '';
            foreach ($params as $key => $value) {
                $queryString .= $key . '=' . $value . '&';
            }
            $queryString = rtrim($queryString, '&');

            $paymentUrl = $this->cfg['ic_payment_url'] . '?' . $queryString;

            return $paymentUrl;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 500);
        }
    }

    private function generateEncryption($data)
    {

        // AES-128-ECB or AES-256-ECB (depends on ICICI doc)
        $cipher = "AES-128-ECB";
        $encrypted = openssl_encrypt($data, $cipher, $this->cfg['ic_key'], OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }
}
