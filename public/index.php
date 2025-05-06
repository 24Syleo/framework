<?php

require_once '../vendor/autoload.php';
require_once '../src/util/SafeXss.php';
session_start();

use Syleo24\Framework\core\Router;
use Syleo24\Framework\util\Config;
use Syleo24\Framework\middlewares\CsrfMiddleware;
use Syleo24\Framework\middlewares\RoleMiddleware;

Config::getEnv();

define('ROOT', dirname(__DIR__));
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();

// Middleware global
$router->use(CsrfMiddleware::class);

// Middleware pour les routes avec un rôle admin
$router->middleware('users', RoleMiddleware::check(['admin']));
$router->middleware('user_add', RoleMiddleware::check(['admin']));
$router->middleware('client_add', RoleMiddleware::check(['admin']));

// Middleware pour les routes avec un rôle user et admin
$router->middleware('user', RoleMiddleware::check(['admin', 'user']));
$router->middleware('user_update', RoleMiddleware::check(['admin', 'user']));

// Middleware pour les routes avec un rôle client et admin
$router->middleware('client', RoleMiddleware::check(['admin', 'client']));
$router->middleware('client_update', RoleMiddleware::check(['admin', 'client']));


// Routes GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/login', 'AuthController#login', 'login');
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


// API ou autres

// Dispatching
try {
    $router->dispatch();
} catch (Exception $e) {
    $router->redirect('/error');
}
