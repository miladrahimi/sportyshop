<?php

namespace App\Services\Sms;

class Candoo implements Sms
{
    /**
     * @inheritDoc
     */
    public function send(string $cellphone, string $body): void
    {
        $query = http_build_query([
            'username' => config('sms.drivers.candoo.username'),
            'password' => '__password__',
            'src' => config('sms.drivers.candoo.source'),
            'flash' => config('sms.drivers.candoo.flash'),
            'command' => 'send',
            'destinations' => $cellphone,
            'body' => $body,
        ]);

        $query = str_replace(
            '__password__',
            config('sms.drivers.candoo.password'),
            $query
        );

        $options = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        file_get_contents(join('', [
            config('sms.drivers.candoo.endpoint'),
            '/services/URLService/URN?',
            $query
        ]), false, stream_context_create($options));
    }
}
