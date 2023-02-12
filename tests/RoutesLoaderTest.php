<?php

namespace Test;

use Reneknox\Router\Exceptions\RouteFileNotFoundException;
use Reneknox\Router\Route;
use Reneknox\Router\Router;
use Reneknox\Router\RoutersLoader;
use PHPUnit\Framework\TestCase;

class RoutesLoaderTest extends TestCase
{
    /** @test */
    public function routes_load_fails()
    {
        $routesLoader = new RoutersLoader();
        $this->expectException(RouteFileNotFoundException::class);
        $routesLoader->load('example1');
    }

    /** @test */
    public function routes_load_success()
    {
        $routesLoader = new RoutersLoader();
        $routesLoader->load(__DIR__ . DIRECTORY_SEPARATOR . 'example');
        $routes = (new Router())->get_routes();
        $this->assertEquals($routes, Route::get_routes());
    }
}