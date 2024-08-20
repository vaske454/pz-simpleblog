<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;

class HomeController
{
    public function index(Request $request): Response
    {
        $view = new View(__DIR__ . '/../../templates/home.php');

        return new Response($view->render());
    }
}
