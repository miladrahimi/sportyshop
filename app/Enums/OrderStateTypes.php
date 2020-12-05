<?php


namespace App\Enums;

use MiladRahimi\Enum\Enum;

class OrderStateTypes extends Enum
{
    const PAYING = 1;
    const PAYED = 2;
    const SENDING = 3;
    const SENT = 4;
    const FAILED_BY_GATEWAY = 5;
    const CANCELLED_BY_USER = 6;

    public static function isCancellable(?int $type): bool
    {
        return $type == null || $type == static::PAYING;
    }
}
