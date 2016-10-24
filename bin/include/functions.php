<?php

/**
 * Base functions of bin-files.
 */

function colorStr($str, $code)
{
    return sprintf('%s[%dm%s%s[0m', chr(27), getColorCode($code), $str, chr(27));
}

function getColorCode($name)
{
    $styles = [
        'red' => 31,
        'green' => 32,
        'yellow' => 33,
        'blue' => 34,
        'magenta' => 35,
        'cyan' => 36,
        'white' => 37,
    ];
    return $styles[$name];
}
