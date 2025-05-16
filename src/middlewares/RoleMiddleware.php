<?php

namespace Syleo24\Framework\middlewares;

use Syleo24\Framework\entity\User;
use Syleo24\Framework\util\FlashMessage;

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
                FlashMessage::set("Role pas assez élevé", 'error');
                return false;
            }

            return true;
        };
    }
}
