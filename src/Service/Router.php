<?php

namespace App\Service;

use App\Http\Request;
use App\Http\Response;
use App\Util\YamlParser;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->loadRoutes();
    }

    private function loadRoutes(): void
    {
        $yamlFile = __DIR__ . '/../../config/routes.yaml';
        $yaml = YamlParser::parseFile($yamlFile);
        $this->routes = [];

        foreach ($yaml as $route) {
            $this->routes[$route['path']] = $route['controller'];
        }
    }

    public function execute(Request $request): Response
    {
        $path = $request->getPath();

        if (!array_key_exists($path, $this->routes)) {
            return new Response('404 Not Found');
        }

        $controllerInfo = $this->routes[$path];
        list($controllerClass, $method) = explode('::', $controllerInfo);
        $controller = new $controllerClass();

        return $controller->$method($request);
    }
}
