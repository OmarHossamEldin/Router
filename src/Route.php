<?php

namespace Reneknox\Router;

class Route
{
    private static $routes = [];

    public static function get_routes(): array
    {
        return self::$routes;
    }

    public static function get(string $uri, $action): void
    {
        self::register('GET', $uri, $action);
    }

    public static function post(string $uri, $action): void
    {
        self::register('POST', $uri, $action);
    }

    public static function put(string $uri, $action): void
    {
        self::register('PUT', $uri, $action);
    }

    public static function patch(string $uri, $action): void
    {
        self::register('PATCH', $uri, $action);
    }

    public static function delete(string $uri, $action): void
    {
        self::register('DELETE', $uri, $action);
    }

    private static function register(string $method, string $uri, $action): void
    {
        self::$routes[$method][$uri] = $action;
    }
}