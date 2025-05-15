<?php

namespace Syleo24\Framework\core;

use AltoRouter;
use Exception;

class Router
{
    private AltoRouter $router;
    private string $controllerNamespace = 'Syleo24\\Framework\\controller';
    private array $routeMiddlewares = [];
    private array $globalMiddlewares = [];

    public function __construct()
    {
        $this->router = new AltoRouter();
    }

    // Méthodes pour enregistrer les routes
    public function get(string $route, string $target, string $name)
    {
        $this->router->map('GET', $route, $target, $name);
    }

    public function post(string $route, string $target, string $name)
    {
        $this->router->map('POST', $route, $target, $name);
    }

    public function delete(string $route, string $target, string $name)
    {
        $this->router->map('DELETE', $route, $target, $name);
    }

    public function any(string $route, string $target, string $name)
    {
        $this->router->map('GET|POST', $route, $target, $name);
    }

    // Enregistre un middleware global (toutes les routes)
    public function use(string $middlewareClass)
    {
        $this->globalMiddlewares[] = $middlewareClass;
    }

    // Ajoute un middleware à une route nommée (accumulable)
    public function middleware(string $routeName, callable $callback)
    {
        $this->routeMiddlewares[$routeName][] = $callback;
    }

    // Optionnel : middleware en lot pour plusieurs routes
    public function groupMiddleware(array $routeNames, array $middlewares)
    {
        foreach ($routeNames as $routeName) {
            foreach ($middlewares as $middleware) {
                $this->middleware($routeName, $middleware);
            }
        }
    }

    // Lancer la bonne route avec middlewares
    public function dispatch()
    {
        $match = $this->router->match();

        if (!$match) {
            throw new Exception("Aucune route ne correspond.");
        }

        $routeName = $match['name'] ?? null;

        // 1. Appliquer les middlewares globaux
        foreach ($this->globalMiddlewares as $middlewareClass) {
            if (method_exists($middlewareClass, 'handle')) {
                $middlewareClass::handle();
            }
        }

        // 2. Appliquer les middlewares spécifiques à la route
        if ($routeName && isset($this->routeMiddlewares[$routeName])) {
            foreach ($this->routeMiddlewares[$routeName] as $middleware) {
                $result = call_user_func($middleware);
                if ($result === false) {
                    throw new Exception("Accès non autorisé.");
                }
            }
        }

        // 3. Appeler le contrôleur
        list($controllerName, $method) = explode('#', $match['target']);
        $controllerClass = $this->controllerNamespace . '\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            throw new Exception("Contrôleur $controllerClass introuvable.");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            throw new Exception("Méthode $method introuvable dans $controllerClass.");
        }

        call_user_func_array([$controller, $method], $match['params']);
    }

    // Génère une URL depuis le nom de la route
    public function generate(string $routeName, array $params = []): ?string
    {
        return $this->router->generate($routeName, $params);
    }

    // Redirection HTTP
    public function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}
