<?php

namespace App\Services\Sms;

interface Sms
{
    /**
     * Send a single SMS message
     *
     * @param string $cellphone
     * @param string $content
     */
    public function send(string $cellphone, string $content): void;
}
