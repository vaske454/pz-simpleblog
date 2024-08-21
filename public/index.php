<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Request;
use App\Service\Container;
use App\Service\Router;
use App\Http\Response;

// Create a dependency injection container
$container = new Container();

// Create a router instance with the container
$router = new Router($container);

// Create a request instance (ensure this is set up correctly)
$request = new Request();

try {
    // Execute the route and get the response
    $response = $router->execute($request);
} catch (Exception $e) {
    // Handle any exceptions
    // For example, log the error and show a generic message to the user
    error_log("Exception: " . $e->getMessage() . " Code: " . $e->getCode());

    // Display a generic error message to the user
    $response = new Response('An error occurred. Please try again later.');
}

// Output the response content
echo $response->getContent();
