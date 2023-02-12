<?php

namespace Reneknox\Router\Exceptions;

use Exception;

class RouteFileNotFoundException extends Exception
{
    protected $message = 'Route File Not Found Exception';
}