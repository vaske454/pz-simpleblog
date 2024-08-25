<?php

namespace App\Services;

use App\Model\BlogPost;
use App\Model\User;
use App\Exception\AuthorizationException;
use App\Exception\BlogPostException;

class BlogService
{
    private $blogPost;

    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @throws AuthorizationException
     */
    private function ensureLoggedIn()
    {
        if (!$this->isLoggedIn()) {
            throw new AuthorizationException('User is not logged in.');
        }
    }

    /**
     * @throws AuthorizationException
     */
    private function getUserId()
    {
        $this->ensureLoggedIn();
        if ($_SESSION['user'] instanceof User) {
            return $_SESSION['user']->id;
        }
        return null;
    }

    /**
     * @throws BlogPostException|AuthorizationException
     */
    public function createBlogPost($title, $content, $categoryId)
    {
        $this->ensureLoggedIn();
        $userId = $this->getUserId();
        if ($userId === null) {
            throw new BlogPostException('User ID not found.');
        }

        try {
            $this->blogPost->create($title, $content, $userId, $categoryId);
        } catch (\Exception $e) {
            throw new BlogPostException('Failed to create blog post: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws BlogPostException|AuthorizationException
     */
    public function updateBlogPost($blogId, $title, $content, $categoryId)
    {
        $this->ensureLoggedIn();
        $userId = $this->getUserId();
        if ($userId === null) {
            throw new BlogPostException('User ID not found.');
        }

        try {
            $this->blogPost->update($blogId, $title, $content, $userId, $categoryId);
        } catch (\Exception $e) {
            throw new BlogPostException('Failed to update blog post: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws BlogPostException|AuthorizationException
     */
    public function deleteBlogPost($blogId)
    {
        $this->ensureLoggedIn();
        $userId = $this->getUserId();
        if ($userId === null) {
            throw new BlogPostException('User ID not found.');
        }

        try {
            $this->blogPost->delete($blogId, $userId);
        } catch (\Exception $e) {
            throw new BlogPostException('Failed to delete blog post: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws BlogPostException|AuthorizationException
     */
    public function createComment($blogId, $content)
    {
        $this->ensureLoggedIn();
        $userId = $this->getUserId();
        if ($userId === null) {
            throw new BlogPostException('User ID not found.');
        }

        $userDetails = User::getUsernameById($userId);
        $username = isset($userDetails['username']) ? $userDetails['username'] : 'Anonymous';

        try {
            $this->blogPost->createComment($content, $blogId, $username);
        } catch (\Exception $e) {
            throw new BlogPostException('Failed to create comment: ' . $e->getMessage(), 0, $e);
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}
