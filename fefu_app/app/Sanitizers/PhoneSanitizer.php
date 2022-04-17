<?php

namespace App\Sanitizers;

class PhoneSanitizer
{
    public static function sanitize(?string $value) : ?string {
        if ($value === null) {
            return null;
        }
        $value = preg_replace('/\D+/', '', $value);
        return '7' . substr($value, 1);
    }
}