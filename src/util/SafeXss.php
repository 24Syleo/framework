<?php

use Syleo24\Framework\security\XSSSanitizer;

if (!function_exists('e')) {
    function e($value)
    {
        return XSSSanitizer::sanitize($value);
    }
}
