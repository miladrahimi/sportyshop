<?php


namespace App\Enums;

use MiladRahimi\Enum\Enum;

class OrderStateTypes extends Enum
{
    const PAYING = 1;
    const PAYED = 2;
    const SENDING = 3;
    const SENT = 4;
    const FAILED = 5;
}
