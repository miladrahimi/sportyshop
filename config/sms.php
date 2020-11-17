<?php

return [
    'driver' => env('SMS_DRIVER', 'log'),

    'drivers' => [
        'candoo' => [
            'endpoint' => env('SMS_CANDOO_ENDPOINT', 'https://my.candoosms.com'),
            'username' => env('SMS_CANDOO_USERNAME'),
            'password' => env('SMS_CANDOO_PASSWORD'),
            'source' => env('SMS_CANDOO_SOURCE'),
            'flash' => env('SMS_CANDOO_FLASH', 0),
        ]
    ],
];
