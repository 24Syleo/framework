<?php

namespace Syleo24\Framework\middlewares;

use Syleo24\Framework\util\FlashMessage;

class RequireLoginMiddleware
{
    public static function check()
    {
        if (empty($_SESSION['user'])) {
            FlashMessage::set('Vous devez être connecté pour accéder à cette page.', 'error');
            header('Location: /login');
            http_response_code(401);
            exit;
        }
    }
}
