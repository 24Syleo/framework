<?php

namespace Syleo24\Framework\middlewares;

use Syleo24\Framework\util\FlashMessage;

class CsrfMiddleware
{
    public static function handle()
    {
        if (in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'DELETE'])) {
            session_start();

            // Récupération uniquement via header
            $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;

            if (!$token || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
                FlashMessage::set('Erreur : Requête CSRF invalide ou manquante', 'error');
                http_response_code(403);
                echo json_encode([
                    'success' => false,
                    'message' => 'Requête CSRF invalide ou manquante',
                ]);
                exit;
            }
        }
    }
}
