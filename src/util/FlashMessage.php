<?php

namespace Syleo24\Framework\util;

class FlashMessage
{
    const FLASH_KEY = 'flash_message';

    // Définir un message flash avec un type
    public static function set(string $message, string $type = 'success')
    {
        // Vérification pour ne permettre que 'error' ou 'success' comme types
        if (!in_array($type, ['success', 'error'])) {
            $type = 'success';  // Valeur par défaut 'success'
        }

        // Enregistrement du message et du type dans la session
        $_SESSION[self::FLASH_KEY] = ['message' => $message, 'type' => $type];
    }

    // Récupérer le message flash et le supprimer de la session
    public static function get()
    {
        if (isset($_SESSION[self::FLASH_KEY])) {
            $flash = $_SESSION[self::FLASH_KEY];
            unset($_SESSION[self::FLASH_KEY]); // Suppression après lecture
            return $flash;
        }
        return null;
    }
}
