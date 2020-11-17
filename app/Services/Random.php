<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class Random
{
    public function int(int $length): int
    {
        $min = intval(str_repeat('1', $length));
        $max = intval(str_repeat('9', $length));

        try {
            return random_int($min, $max);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTraceAsString());
            return $this->int($length);
        }
    }
}
