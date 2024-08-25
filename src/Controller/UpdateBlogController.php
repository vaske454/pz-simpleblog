<?php

namespace App\Controller;

use App\Services\BlogService;

class UpdateBlogController
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function updateBlogPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $content = isset($_POST['content']) ? $_POST['content'] : '';
            $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $blogId = isset($_POST['id']) ? $_POST['id'] : '';

            // Validate input
            if (empty($title) || empty($content) || empty($categoryId) || empty($blogId)) {
                header('Location: /');
                exit;
            }

            try {
                $this->blogService->updateBlogPost($blogId, $title, $content, $categoryId);

                header('Location: /');
                exit;
            } catch (\Exception $e) {
                // Log the error or display a message
                echo 'Failed to update blog post: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
            }
        } else {
            header('Location: /');
            exit();
        }
    }
}
