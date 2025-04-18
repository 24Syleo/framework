<?php
require_once './vendor/autoload.php';

use Syleo24\Framework\util\Config;
use Syleo24\Framework\util\Database;

Config::getEnv();


try {
    $pdo = Database::connect();
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);
    echo "✅ Base de données créée avec succès !\n";
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
