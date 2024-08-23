<?php

namespace App\Service;

use App\Model\BlogPost;
use App\Model\User;

class BlogService
{
    public function __construct()
    {
        session_start();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function getUserId()
    {
        if ($this->isLoggedIn() && $_SESSION['user'] instanceof User) {
            return $_SESSION['user']->id;
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    public function createBlogPost($title, $content)
    {
        if (!$this->isLoggedIn()) {
            throw new \Exception('User is not logged in.');
        }

        $userId = $this->getUserId();
        if ($userId === null) {
            throw new \Exception('User ID not found.');
        }

        BlogPost::create($title, $content, $userId);
    }


    /**
     * @throws \Exception
     */
    public function getBlogPostById($id)
    {
        $blogPost = BlogPost::getById($id);

        if ($blogPost) {
            // Fetch username based on user_id
            $user = User::getById($blogPost['user_id']);
            $blogPost['username'] = $user['username'];
            unset($blogPost['user_id']); // Remove user_id if you don't want to display it
        }

        return $blogPost;
    }
    
}
