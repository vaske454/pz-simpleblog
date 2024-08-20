<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Request;
use App\Service\Router;

$router = new Router();
$request = new Request();
$response = $router->execute($request);

echo $response->getContent();