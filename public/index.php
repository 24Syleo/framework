<?php

require_once '../vendor/autoload.php';
session_start();

use Syleo24\Framework\core\Router;
use Syleo24\Framework\util\Config;
use Syleo24\Framework\middlewares\CsrfMiddleware;

Config::getEnv();

define('ROOT', dirname(__DIR__));
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();

// Middleware global
$router->use(CsrfMiddleware::class);
// Routes GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/login', 'AuthController#login', 'login');
$router->get('/logout', 'AuthController#logout', 'logout');
$router->get('/users', 'UserController#index', 'users');
$router->get('/user/[i:id]', 'UserController#edit', 'user');
$router->get('/error', 'ErrorController#index', 'error');
// Routes POST
$router->post('/user/add', 'UserController#add', 'user_add');
$router->post('/user/update/[i:id]', 'UserController#update', 'user_update');
$router->post('/handleLogin', 'AuthController#handleLogin', 'handleLogin');


// API ou autres

// Dispatching
try {
    $router->dispatch();
} catch (Exception $e) {
    $router->redirect('/error');
}
