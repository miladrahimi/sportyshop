<?php

use Carbon\Carbon;

function jDate(Carbon $datetime, $format = 'yyyy-MM-dd - hh:mm:ss', $fixNumbers = true): string
{
    $formatter = new IntlDateFormatter(
        "fa_IR@calendar=persian",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );

    $result = $formatter->format($datetime);

    return $fixNumbers ? fixNumbers($result) : $result;
}

function fixNumbers(string $string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $num = range(0, 9);

    $convertedPersianNums = str_replace($persian, $num, $string);

    return str_replace($arabic, $num, $convertedPersianNums);
}

/**
 * Append hash to the given file
 *
 * @param string $url
 * @return string
 */
function fh(string $url): string
{
    return $url . '?h=' . md5_file(public_path(parse_url($url)['path']));
}

/**
 * Generate photo url from photo file path
 *
 * @param string|null $path
 * @return string
 */
function photoUrl(?string $path): string
{
    return $path ? asset($path) : asset('img/product.jpg');
}

