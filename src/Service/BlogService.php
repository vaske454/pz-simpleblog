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
    
}
