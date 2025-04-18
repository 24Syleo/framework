<?php

namespace Syleo24\Framework\core;

use AltoRouter;
use Exception;

class Router
{
    private AltoRouter $router;
    private string $controllerNamespace = 'Syleo24\\Framework\\controller';
    private array $middlewares = [];

    public function __construct()
    {
        $this->router = new AltoRouter();
        // $this->router->setBasePath('/public'); // optionnel
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

    // Ajouter un middleware pour une route nommée
    public function middleware(string $routeName, callable $callback)
    {
        $this->middlewares[$routeName] = $callback;
    }

    // Lancer la bonne route
    public function dispatch()
    {
        $match = $this->router->match();

        if (!$match) {
            throw new Exception("Aucune route ne correspond.");
        }

        $routeName = $match['name'] ?? null;

        // Vérifie si un middleware est associé à cette route
        if ($routeName && isset($this->middlewares[$routeName])) {
            $result = call_user_func($this->middlewares[$routeName]);
            if ($result === false) {
                throw new Exception("Accès non autorisé.");
            }
        }

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

    public function generate(string $routeName, array $params = []): ?string
    {
        return $this->router->generate($routeName, $params);
    }

    public function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}
