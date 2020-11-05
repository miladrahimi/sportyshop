<?php

namespace App\Services;

class TagManager
{
    private static $endingChars = [
        '#', ' ', "\n", "\r"
    ];

    public function extract(string $content): array
    {
        $tags = [];

        for ($i = 0; $i < strlen($content); $i++) {
            if ($content[$i] != '#') continue;

            $tag = '';

            $i++;
            while (isset($content[$i]) && !in_array($content[$i], static::$endingChars)) {
                $tag .= $content[$i];
                $i++;
            }

            $tags[] = $tag;
            $i--;
        }

        return $tags;
    }
}
