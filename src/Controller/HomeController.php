<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;
use App\Model\BlogPost;

class HomeController
{
    public function __construct()
    {
        // Start the session for all requests to the controller
        session_start();
    }

    public function index(Request $request)
    {
        $title = 'Home - My Blog';
        $blogs = BlogPost::getAll();
        $view = new View(__DIR__ . '/../../templates/pages/home.php', $title, ['blogs' => $blogs]);

        return new Response($view->render());
    }
}
