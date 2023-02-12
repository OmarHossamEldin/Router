<?php

namespace Reneknox\Router;

use Reneknox\Router\Exceptions\RouteFileNotFoundException;
use Exception;

class RoutersLoader
{
    public function load(string $filePath): RoutersLoader
    {
        try {
            require_once $filePath . '.php';
            return $this;
        } catch (Exception $exception) {
            throw new RouteFileNotFoundException();
        }
    }
}