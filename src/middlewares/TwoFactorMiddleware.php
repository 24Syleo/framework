<?php

namespace Syleo24\Framework\middlewares;

use Syleo24\Framework\util\FlashMessage;

class TwoFactorMiddleware
{
    public static function check()
    {
        // Si 2fa false
        if (!isset($_SESSION['2fa_verified']) || $_SESSION['2fa_verified'] !== true) {
            FlashMessage::set('Erreur : double authentification non validé', 'error');
            http_response_code(403);
            header('Location: /tfa');
            exit;
        }
    }
}
