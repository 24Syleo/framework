<?php

namespace Syleo24\Framework\security;

class XSSSanitizer
{
    /**
     * Protège une valeur contre les attaques XSS.
     * Peut traiter des chaînes ou des tableaux récursivement.
     *
     * @param mixed $data
     * @return mixed
     */
    public static function sanitize($data)
    {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }

        return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
