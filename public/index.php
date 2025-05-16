<?php

require_once '../vendor/autoload.php';
require_once '../src/util/SafeXss.php';
session_start();

use Syleo24\Framework\core\Router;
use Syleo24\Framework\util\Config;
use Syleo24\Framework\middlewares\CsrfMiddleware;
use Syleo24\Framework\middlewares\RequireLoginMiddleware;
use Syleo24\Framework\middlewares\RoleMiddleware;
use Syleo24\Framework\middlewares\TwoFactorMiddleware;

Config::getEnv();

define('ROOT', dirname(__DIR__));
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();

// Middleware global
$router->use(CsrfMiddleware::class);

// Middleware global
$router->use(CsrfMiddleware::class);

// Middleware pour connexion requise (ex: tfa)
$router->groupMiddleware([
    'tfa',
    'users',
    'user',
    'clients',
    'client'
], [
    [RequireLoginMiddleware::class, 'check']
]);


// Groupes de routes nécessitant la double auth
$router->groupMiddleware([
    'users',
    'user',
    'clients',
    'client'
], [
    [TwoFactorMiddleware::class, 'check']
]);

// Routes nécessitant rôle admin
$router->groupMiddleware([
    'users',
    'user_add',
    'client_add'
], [
    RoleMiddleware::check(['admin'])
]);

// Rôle user ou admin
$router->groupMiddleware([
    'user',
    'user_update'
], [
    RoleMiddleware::check(['admin', 'user'])
]);

// Rôle client ou admin
$router->groupMiddleware([
    'client',
    'client_update'
], [
    RoleMiddleware::check(['admin', 'client'])
]);


// Routes GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/login', 'AuthController#login', 'login');
$router->get('/tfa', 'AuthController#tfa', 'tfa');
$router->get('/logout', 'AuthController#logout', 'logout');
$router->get('/users', 'UserController#index', 'users');
$router->get('/clients', 'ClientController#index', 'clients');
$router->get('/user/[i:id]', 'UserController#edit', 'user');
$router->get('/client/[i:id]', 'ClientController#edit', 'client');
$router->get('/error', 'ErrorController#index', 'error');
// Routes POST
$router->post('/user/add', 'UserController#add', 'user_add');
$router->post('/client/add', 'ClientController#add', 'client_add');
$router->post('/user/update/[i:id]', 'UserController#update', 'user_update');
$router->post('/client/update/[i:id]', 'ClientController#update', 'client_update');
$router->post('/handleLogin', 'AuthController#handleLogin', 'handleLogin');
$router->post('/handleTfa', 'AuthController#handleTfa', 'handleTfa');


// API ou autres

// Dispatching
try {
    $router->dispatch();
} catch (Exception $e) {
    $router->redirect('/error');
}
