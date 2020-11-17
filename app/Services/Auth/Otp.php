<?php

namespace App\Services\Auth;

use App\Services\Random;
use Illuminate\Support\Facades\Redis;

class Otp
{
    const CODE_LENGTH = 6;
    const REAL_TTL = 5 * 60;
    const SHOW_TTL = 2 * 60;

    /**
     * @var Redis
     */
    private $redis;

    /**
     * @var Random
     */
    private $random;

    public function __construct()
    {
        $this->redis = Redis::connection('otp')->client();
        $this->random = new Random();
    }

    public function exist(string $cellphone): bool
    {
        return $this->redis->ttl($cellphone) > static::REAL_TTL - static::SHOW_TTL;
    }

    public function ttl(string $cellphone): int
    {
        return $this->redis->ttl($cellphone) > static::SHOW_TTL ?
            $this->redis->ttl($cellphone) - (static::REAL_TTL - static::SHOW_TTL) : 0;
    }

    public function generate(string $cellphone): string
    {
        $code = $this->random->int(static::CODE_LENGTH);

        $this->redis->set($cellphone, $code);
        $this->redis->expire($cellphone, static::REAL_TTL);

        return $code;
    }

    public function check(string $cellphone, string $code): bool
    {
        return ($c = $this->redis->get($cellphone)) && $c == $code;
    }
}
