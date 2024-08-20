<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;

class HomeController
{
    public function index(Request $request): Response
    {
        $title = 'Home - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/home.php', $title);

        return new Response($view->render());
    }
}
