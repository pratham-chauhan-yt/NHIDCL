<?php

return [

    'default' => 'rp_info_tel',

    'drivers' => [

        'rp_info_tel' => [
            'base_uri'   => env('RP_IC_PAYMENT_URL'),
            'username'   => env('RP_USERNAME'),
            'apikey'     => env('RP_API_KEY'),
            'signature'  => env('RP_SIGNATURE'),
            'msgtype'  => env('RP_MSGTYPE')
        ],

    ],
];
