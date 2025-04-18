<?php

namespace Syleo24\Framework\util;

use Symfony\Component\Dotenv\Dotenv;

class Config
{

    /**
     * Charger et obtenir les variables d'environnements
     * @return void
     */
    public static function getEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env');
    }
}
