<?php
require_once '../vendor/autoload.php';
session_start();

use Syleo24\Framework\core\Router;
use Syleo24\Framework\util\Config;

Config::getEnv();

define('ROOT', dirname(__DIR__));
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();
// Routes GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/users', 'UserController#index', 'users');
$router->get('/user/[i:id]', 'UserController#edit', 'user');
$router->get('/error', 'ErrorController#index', 'error');
// Routes POST
$router->post('/user/add', 'UserController#add', 'user_add');
$router->post('/user/update/[i:id]', 'UserController#update', 'user_update');

// API ou autres

// Dispatching
try {
    $router->dispatch();
} catch (Exception $e) {
    $router->redirect('/error');
}
