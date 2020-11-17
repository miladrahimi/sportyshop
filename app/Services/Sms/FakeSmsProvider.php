<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log;

class FakeSmsProvider implements Sms
{
    /**
     * @inheritDoc
     */
    public function send(string $cellphone, string $content): void
    {
        Log::info('Sms sent.', [
            'cellphone' => $cellphone,
            'content' => $content,
        ]);
    }
}
