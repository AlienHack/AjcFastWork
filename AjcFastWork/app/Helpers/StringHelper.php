<?php

namespace App\Helpers;

class StringHelper {
    public static function GetTrimText(string $text, int $length): string
    {
        return mb_substr($text, 0, $length, 'UTF-8') . (strlen($text) > $length ? '...' : '');
    }
}
