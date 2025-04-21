<?php

namespace Syleo24\Framework\middlewares;

use Syleo24\Framework\entity\User;

class RoleMiddleware
{
    public static function check(array $allowedRoles): callable
    {
        return function () use ($allowedRoles) {
            if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof User)) {
                header('Location: /login');
                exit;
            }

            /** @var User $user */
            $user = $_SESSION['user'];

            if (!in_array($user->getRole(), $allowedRoles)) {
                header('HTTP/1.1 403 Forbidden');
                echo "Accès refusé : rôle requis.";
                return false;
            }

            return true;
        };
    }
}
