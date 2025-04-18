<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Syleo24\Framework\core\Router;

final class RouterTest extends TestCase
{
    public function testGenerateSimpleRoute(): void
    {
        $router = new Router();
        // On enregistre une route GET nommée "hello"
        $router->get('/hello/[i:id]', 'HomeController#index', 'hello');

        // On génère l'URL en passant le paramètre id=7
        $url = $router->generate('hello', ['id' => 7]);

        // On s'attend à obtenir "/hello/7"
        $this->assertEquals('/hello/7', $url);
    }

    public function testGenerateMissingRouteReturnsNull(): void
    {
        $router = new Router();
        // Aucune route nommée "inconnue"
        $url = $router->generate('inconnue', []);
        $this->assertNull($url);
    }
}
