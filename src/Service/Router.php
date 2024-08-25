<?php

namespace App\Service;

use App\Http\Request;
use App\Http\Response;
use App\Util\YamlParser;

class Router
{
    private $routes;
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->loadRoutes();
    }

    private function loadRoutes()
    {
        $yamlFile = __DIR__ . '/../../config/routes.yaml';
        $yaml = YamlParser::parseFile($yamlFile);
        $this->routes = array();

        foreach ($yaml as $route) {
            $this->routes[$route['path']] = $route['controller'];
        }
    }

    /**
     * @throws \Exception
     */
    private function getService($id)
    {
        if (!isset($this->services[$id])) {
            throw new \Exception("Service not found: $id");
        }

        return $this->services[$id];
    }



    /**
     * @throws \Exception
     */
    public function execute(Request $request)
    {
        $path = $request->getPath();

        if (!array_key_exists($path, $this->routes)) {
            $view = new View(__DIR__ . '/../../templates/pages/404.php');
            return new Response($view->render());
        }

        $controllerInfo = $this->routes[$path];
        list($controllerClass, $method) = explode('::', $controllerInfo);

        // Check if the container has the controller (implies it has dependencies)
        if ($this->container->has($controllerClass)) {
            $controller = $this->container->get($controllerClass);
        } else {
            // Fallback to direct instantiation if the controller does not have dependencies
            $controller = new $controllerClass();
        }

        return $controller->$method($request);
    }
}
