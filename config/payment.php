<?php

return [
    'gateways' => [
        'idpay' => [
            'url' => env('PAYMENT_GATEWAYS_IDPAY_URL'),
            'key' => env('PAYMENT_GATEWAYS_IDPAY_KEY'),
            'timeout' => env('PAYMENT_GATEWAYS_IDPAY_TIMEOUT', 10),
            'sandbox' => env('PAYMENT_GATEWAYS_IDPAY_SANDBOX', true),
        ],
    ],
];
