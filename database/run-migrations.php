<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Syleo24\Framework\util\Config;
use Syleo24\Framework\util\Database;

Config::getEnv();
$pdo = Database::connect();

// Fichier pour suivre les migrations déjà exécutées
$logFile = __DIR__ . '/migrations.log';
if (!file_exists($logFile)) file_put_contents($logFile, '');

$executed = file($logFile, FILE_IGNORE_NEW_LINES);
$migrations = glob(__DIR__ . '/migrations/*.sql');
sort($migrations);

foreach ($migrations as $migration) {
    $name = basename($migration);
    if (!in_array($name, $executed)) {
        echo "🚀 Exécution de la migration : $name\n";
        $sql = file_get_contents($migration);
        try {
            $pdo->exec($sql);
            file_put_contents($logFile, $name . PHP_EOL, FILE_APPEND);
            echo "✅ Migration réussie : $name\n";
        } catch (Exception $e) {
            echo "❌ Erreur pendant $name : " . $e->getMessage() . "\n";
            break;
        }
    } else {
        echo "✔️  Déjà exécutée : $name\n";
    }
}
