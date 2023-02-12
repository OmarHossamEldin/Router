<?php

namespace Tests;

use Reneknox\Router\Exceptions\RouteNotFoundException;
use Reneknox\Router\RoutersLoader;
use PHPUnit\Framework\TestCase;
use Reneknox\Router\Resolver;
use Reneknox\Router\Route;

class ResolverTest extends TestCase
{
    private RoutersLoader $routersLoader;
    private Resolver $resolver;

    protected function setUp(): void
    {
        $this->routersLoader = new RoutersLoader();
        $this->resolver = new Resolver();
    }

    /** @test */
    public function solve_fails()
    {
        $this->expectException(RouteNotFoundException::class);
        $this->routersLoader->load(__DIR__ . '/example');
        $this->resolver->solve( 'get','/foo/bar', Route::get_routes());
    }

    /** @test */
    public function solve_success()
    {
        $this->routersLoader->load(__DIR__ . '/example');
        $action = $this->resolver->solve('get', '/home', Route::get_routes());
        $this->assertIsCallable($action);
    }

    /** @test */
    public function solve_route_with_one_param_success()
    {
        $this->routersLoader->load(__DIR__ . '/example');
        $action = $this->resolver->solve('get', '/posts/1', Route::get_routes());
        $this->assertIsCallable($action);
    }

    /** @test */
    public function solve_route_with_two_params_or_more_success()
    {
        $this->routersLoader->load(__DIR__ . '/example');
        $action = $this->resolver->solve('get', '/posts/1/reneknox', Route::get_routes());
        $this->assertIsCallable($action);
    }
}