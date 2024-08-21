<?php

namespace App\Service;

use App\Model\User;
use App\Exception\AuthenticationException;

class LoginService
{
    public function __construct()
    {
        session_start();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    /**
     * @throws AuthenticationException
     */
    public function login($username, $password)
    {
        if ($this->isLoggedIn()) {
            // User is already logged in
            return ['redirect' => '/'];
        }

        if (empty($username) || empty($password)) {
            throw new AuthenticationException('Username and password cannot be empty', 1001);
        }

        $user = User::authenticate($username, $password);
        if (!$user) {
            throw new AuthenticationException('Invalid username or password', 1002);
        }

        $_SESSION['user'] = $user;
        return ['redirect' => '/'];
    }
}
