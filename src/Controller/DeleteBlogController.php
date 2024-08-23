<?php

namespace App\Controller;

use App\Service\BlogService;

class DeleteBlogController
{
    private $blogService;

    public function __construct()
    {
        $this->blogService = new BlogService();
    }

    public function deleteBlogPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $blogId = isset($_POST['id']) ? $_POST['id'] : '';

            // Validate input
            if (empty($blogId)) {
                echo 'Blog ID is required.';
                return;
            }

            // Delete blog post
            try {
                $this->blogService->deleteBlogPost($blogId);
                header('Location: /');
                exit;
            } catch (\Exception $e) {
                // Log the error or display a message
                echo 'Failed to delete blog post: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
            }
        } else {
            header('Location: /');
            exit();
        }
    }
}
