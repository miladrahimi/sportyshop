<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log as Logger;

class Log implements Sms
{
    /**
     * @inheritDoc
     */
    public function send(string $cellphone, string $content): void
    {
        Logger::info('Sms sent.', [
            'cellphone' => $cellphone,
            'content' => $content,
        ]);
    }
}
