<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;

class AuthController
{
    public function login(Request $request): Response
    {
        $title = 'Login - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/login.php', $title);

        return new Response($view->render());
    }

    public function register(Request $request): Response
    {
        $title = 'Register - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/register.php', $title);

        return new Response($view->render());
    }
}
