<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;

class AuthController
{
    public function login(Request $request): Response
    {
        $view = new View(__DIR__ . '/../../templates/login.php');

        return new Response($view->render());
    }

    public function register(Request $request): Response
    {
        $view = new View(__DIR__ . '/../../templates/register.php');

        return new Response($view->render());
    }
}
