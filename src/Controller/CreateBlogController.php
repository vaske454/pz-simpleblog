<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\BlogService;
use App\Model\Category;
use App\Service\View;

class CreateBlogController
{
    private $createBlogService;

    public function __construct(BlogService $createBlogService)
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
            $categoryId = $request->get('category_id');
            $this->createBlogService->createBlogPost($title, $content, $categoryId);

            header('Location: /');
            exit();
        }

        $title = 'Create Blog - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/create-blog.php', $title);

        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();

        $view->set('categories', $categories);

        return new Response($view->render());
    }
}
