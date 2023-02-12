<?php

namespace Tests;

use Reneknox\Router\Exceptions\RouteNotFoundException;
use PHPUnit\Framework\TestCase;
use Reneknox\Router\Router;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    /** @test */
    public function solve_fails()
    {
        $this->expectException(RouteNotFoundException::class);
        $this->router->init(__DIR__ . '/example');
        $this->router->serve('get', 'foo/bar');
    }

    /** @test */
    public function solve_success()
    {
        $this->router->init(__DIR__ . '/example');
        $action = $this->router->serve('get', '/home');
        $this->assertIsCallable($action);
    }

}