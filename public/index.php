<?php

use Syleo24\Framework\core\Router;

require_once '../vendor/autoload.php';
session_start();

define('ROOT', dirname(__DIR__));           // => /home/.../framework
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();
// Routes GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/error', 'ErrorController#index', 'error');
// Routes POST

// API ou autres

// Dispatching
try {
    $router->dispatch();
} catch (Exception $e) {
    $router->redirect('/error');
}
