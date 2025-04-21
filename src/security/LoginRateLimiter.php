<?php

namespace Syleo24\Framework\security;

class LoginRateLimiter
{
    private const MAX_ATTEMPTS = 5;
    private const BLOCK_DURATION = 300; // 5 minutes
    private const LOG_FILE = __DIR__ . '/../../logs/logattempt.log';

    public static function isBlocked(string $email): bool
    {
        $attempts = $_SESSION['login_attempts'][$email] ?? null;

        if (!$attempts) return false;

        if ($attempts['count'] >= self::MAX_ATTEMPTS) {
            $blockedUntil = $attempts['last'] + self::BLOCK_DURATION;
            return time() < $blockedUntil;
        }

        return false;
    }

    public static function registerAttempt(string $email): void
    {
        // Enregistrement dans la session
        if (!isset($_SESSION['login_attempts'][$email])) {
            $_SESSION['login_attempts'][$email] = [
                'count' => 1,
                'last' => time(),
            ];
        } else {
            $_SESSION['login_attempts'][$email]['count']++;
            $_SESSION['login_attempts'][$email]['last'] = time();
        }

        // Log dans le fichier
        self::logAttempt($email);
    }

    public static function resetAttempts(string $email): void
    {
        unset($_SESSION['login_attempts'][$email]);
    }

    private static function logAttempt(string $email): void
    {
        $date = date('Y-m-d H:i:s');
        $logLine = "[$date] Tentative échouée pour l'email : $email\n";

        file_put_contents(self::LOG_FILE, $logLine, FILE_APPEND);
    }
}
