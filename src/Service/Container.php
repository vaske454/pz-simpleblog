<?php

namespace App\Service;

use App\Controller\CreateBlogController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\LogoutController;
use App\Controller\SingleBlogController;
use Exception;

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
        $this->services[SingleBlogController::class] = function() {
            return new SingleBlogController($this->get(BlogService::class));
        };
        $this->services[BlogService::class] = function() {
            return new BlogService();
        };
        $this->services[LogoutController::class] = function() {
            return new LogoutController($this->get(LogoutService::class));
        };
        $this->services[LogoutService::class] = function() {
            return new LogoutService();
        };
        // Add other services and controllers
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
