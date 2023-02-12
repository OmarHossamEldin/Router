<?php

namespace Reneknox\Router;

class Router
{
    private RoutersLoader $routersLoader;
    private Resolver $resolver;

    public function __construct()
    {
        $this->routersLoader = new RoutersLoader();
        $this->resolver = new Resolver();
    }

    public function init(string ...$files): Router
    {
        foreach ($files as $file) {
            $this->routersLoader->load($file);
        }
        return $this;
    }

    public function serve(string $method, string $uri)
    {
        return $this->resolver->solve($method, $uri, $this->get_routes());
    }

    public function get_routes(): array
    {
        return Route::get_routes();
    }
}