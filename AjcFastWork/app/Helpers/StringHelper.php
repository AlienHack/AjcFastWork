<?php

namespace App\Helpers;

class StringHelper {
    public static function GetTrimText(string $text, int $length): string
    {
        return substr($text, 0, $length) . (strlen($text) > $length ? '...' : '');
    }
}
