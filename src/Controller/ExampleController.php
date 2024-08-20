<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;

class ExampleController
{
    public function execute(Request $request): Response
    {
        $name = $request->get('name', 'World');
        $view = new View(__DIR__ . '/../../templates/example/hello.php', [
            'name' => htmlspecialchars($name),
        ]);

        return new Response($view->render());
    }
}
