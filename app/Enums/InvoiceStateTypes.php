<?php

namespace App\Enums;

use MiladRahimi\Enum\Enum;

class InvoiceStateTypes extends Enum
{
    const INITIALIZED = 1;
    const PAYING = 2;
    const DONE = 3;
    const FAILED = 4;
}
