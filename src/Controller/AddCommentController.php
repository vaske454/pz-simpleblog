<?php

namespace App\Controller;

use App\Http\Request;
use App\Service\BlogService;

class AddCommentController
{
    private $blogService;

    public function __construct()
    {
        $this->blogService = new BlogService();
    }

    /**
     * @throws \Exception
     */
    public function addComment(Request $request)
    {
        if (!$this->blogService->isLoggedIn()) {
            header('Location: /');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add-comment') {
            $blogId = isset($_POST['id']) ? $_POST['id'] : '';
            $content = isset($_POST['comment']) ? $_POST['comment'] : '';

            // Validate input
            if (empty($blogId)) {
                header('Location: /add-comment');
                exit();
            }

            if (strlen($content) < 1 || strlen($content) > 500) {
                header('Location: /add-comment');
                exit();
            }

            try {
                $this->blogService->createComment($blogId, $content);
                header('Location: /');
                exit;
            } catch (\Exception $e) {
                // Handle other exceptions
                echo 'Failed to create comment: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
            }
        } else {
            header('Location: /');
            exit();
        }
    }
}
