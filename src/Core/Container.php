<?php
namespace App\Core;

use App\Controller\AddCommentController;
use App\Controller\CreateBlogController;
use App\Controller\DeleteBlogController;
use App\Controller\LoginController;
use App\Controller\LogoutController;
use App\Controller\RegisterController;
use App\Controller\UpdateBlogController;
use App\Model\BlogPost;
use App\Model\User;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\LoginService;
use App\Services\LogoutService;
use App\Services\RegistrationService;
use Exception;
use PDOException;

class Container
{
    private $services = [];

    public function __construct()
    {
        // Register services and controllers here
        $this->services[LoginController::class] = function() {
            return new LoginController($this->get(LoginService::class));
        };
        $this->services[LoginService::class] = function() {
            return new LoginService();
        };
        $this->services[RegisterController::class] = function() {
            return new RegisterController($this->get(RegistrationService::class));
        };
        $this->services[RegistrationService::class] = function() {
            return new RegistrationService();
        };
        $this->services[CreateBlogController::class] = function() {
            return new CreateBlogController($this->get(BlogService::class));
        };
        $this->services[UpdateBlogController::class] = function() {
            return new UpdateBlogController($this->get(BlogService::class));
        };

        // Register DeleteBlogController
        $this->services[DeleteBlogController::class] = function() {
            return new DeleteBlogController($this->get(BlogService::class));
        };

        // Register AddCommentController
        $this->services[AddCommentController::class] = function() {
            return new AddCommentController($this->get(BlogService::class));
        };

        // Register BlogService with BlogPost dependency
        $this->services[BlogService::class] = function() {
            return new BlogService($this->get(BlogPost::class));
        };

        // Register BlogPost model
        $this->services[BlogPost::class] = function() {
            return new BlogPost();
        };
        $this->services[User::class] = function() {
            return new User();
        };

        $this->services[LogoutController::class] = function() {
            return new LogoutController($this->get(LogoutService::class));
        };
        $this->services[LogoutService::class] = function() {
            return new LogoutService();
        };
        // Add other services and controllers

        $this->createCategories();
    }

    private function createCategories()
    {
        try {
            $categoryService = new CategoryService();
            $categoryService->ensureCategories();
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }

    /**
     * @throws Exception
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new Exception("Service not found: $id");
        }
        return $this->services[$id]();
    }
}
