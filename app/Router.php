<?php

namespace RickMorty;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    public static function response(array $routes): ?TwigView
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $router) use ($routes) {
            foreach ($routes as $route) {
                [$httpMethod, $url, $handler] = $route;
                $router->addRoute($httpMethod, $url, $handler);
            }
        });

// Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return null;
            case Dispatcher::METHOD_NOT_ALLOWED:
                return null;
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controllerName, $methodName] = $handler;
                $controller = new $controllerName;

                return $controller->{$methodName}();
        }
        return null;
    }
}