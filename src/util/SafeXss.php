<?php

namespace Syleo24\Framework\util;

use Syleo24\Framework\entity\User;

class SafeXss
{
    public static function sanitize(string $input): string
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    public static function user(User $user): User
    {
        $user->setUsername(self::sanitize($user->getUsername()));
        $user->setEmail(self::sanitize($user->getEmail()));
        $user->setRole(self::sanitize($user->getRole()));
        return $user;
    }
}
