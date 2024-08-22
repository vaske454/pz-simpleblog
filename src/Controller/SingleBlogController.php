<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\CreateBlogService;
use App\Service\View;

class SingleBlogController
{
    private $blogPostService;

    public function __construct(CreateBlogService $blogPostService)
    {
        $this->blogPostService = $blogPostService;
    }

    /**
     * @throws \Exception
     */
    public function execute(Request $request)
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            throw new \Exception('Invalid blog post ID.');
        }

        $blogPost = $this->blogPostService->getBlogPostById($id);
        if (!$blogPost) {
            throw new \Exception('Blog post not found.');
        }

        $title = 'Single Blog - My Blog';

        $view = new View(__DIR__ . '/../../templates/pages/single-blog.php', $title, ['blog_post' => $blogPost]);

        return new Response($view->render());
    }
}
