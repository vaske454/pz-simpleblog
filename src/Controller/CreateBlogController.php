<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\CreateBlogService;
use App\Service\View;

class CreateBlogController
{
    private $createBlogService;

    public function __construct(CreateBlogService $createBlogService)
    {
        $this->createBlogService = $createBlogService;
    }

    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if (!$this->createBlogService->isLoggedIn()) {
            header('Location: /');
            exit();
        }

        if ($request->isPost()) {
            $title = $request->get('title');
            $content = $request->get('content');
            $this->createBlogService->createBlogPost($title, $content);

            header('Location: /');
            exit();
        }

        $title = 'Create Blog - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/create-blog.php', $title);

        return new Response($view->render());
    }
}
