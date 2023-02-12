<?php

namespace Reneknox\Router;

use Reneknox\Router\Exceptions\RouteNotFoundException;

class Resolver
{
    public function solve(string $method, string $uri, array $routes)
    {
        $method = strtoupper($method);
        $uri = stripos($uri, '?') ? current(explode('?', $uri)) : $uri;
        $action = $this->get_action($method, $uri, $routes);
        if (!$action) {
            throw new RouteNotFoundException();
        }
        return $action;
    }

    private function get_action(string $method, string $uri, array $routes)
    {
        $action = $routes[$method][$uri] ?? null;
        if (!$action) {
            return $this->check_for_action_with_params($method, $uri, $routes) ?? null;
        }
        return $action;
    }

    private function check_for_action_with_params(string $method, string $uri, array $routes)
    {
        $intendedRoutes = $routes[$method];
        foreach ($intendedRoutes as $route => $action) {

            $paramsNames = $this->extract_route_params_names($route);

            if ($paramsNames === false) continue;

            $regexValidation = $this->convert_route_into_regex_validation_for_intended_uri($route);

            [$status, $paramsValues] = $this->validate_intended_uri($regexValidation, $uri);

            if ($status === false) continue;
            $_REQUEST = array_combine($paramsNames, $paramsValues);
            return $action;
        }
        return null;
    }

    private function extract_route_params_names(string $route)
    {
        $route = trim($route, '/');
        if (!$route) return false;
        if (preg_match_all('/' . Patterns::PARAMETERS_NAMES . '/', $route, $matches)) {
            return $matches['paramsNames'];
        }
        return false;
    }

    private function convert_route_into_regex_validation_for_intended_uri(string $route): string
    {
        $route = trim($route, '/');
        return '^' . preg_replace('/' . Patterns::PARAMETERS_NAMES . '/', Patterns::PARAMETERS_ALLOWED_VALUES, $route) . '$';
    }

    private function validate_intended_uri(string $regexValidation, string $uri): array
    {
        $uri = trim($uri, '/');
        $regexValidation = '@' . $regexValidation . '@';
        if (preg_match_all($regexValidation, $uri, $paramsValues)) {
            array_shift($paramsValues);
            $paramsValuesCount = count($paramsValues);
            $extractedValues = [];
            for ($i = 0; $i < $paramsValuesCount; $i++){
                $extractedValues[] = current($paramsValues[$i]);
            }
            return [true, $extractedValues];
        }
        return [false, []];
    }
}