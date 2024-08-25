<?php

namespace App\Services;

use App\Model\User;
use App\Exception\RegistrationException;

class RegistrationService
{
    public function __construct()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function isValidPassword($password)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,32}$/';
        return preg_match($pattern, $password);
    }

    public function isValidUsername($username)
    {
        $pattern = '/^[a-zA-Z0-9._-]{3,30}$/';
        return preg_match($pattern, $username);
    }

    /**
     * @throws RegistrationException
     */
    public function register($username, $password)
    {
        if (empty($username)) {
            throw new RegistrationException('Username cannot be empty', 2002);
        }

        if (empty($password)) {
            throw new RegistrationException('Password cannot be empty', 2004);
        }

        if (!$this->isValidUsername($username)) {
            throw new RegistrationException('Username must be 3-30 characters long and can only include letters, numbers, dots, underscores, and hyphens.', 2003);
        }

        if (!$this->isValidPassword($password)) {
            throw new RegistrationException('Password must be 8-32 characters long, contain at least one uppercase letter, one number, and one special character.', 2005);
        }

        try {
            $user = User::create($username, $password);
            $_SESSION['user'] = $user;
            return $user;
        } catch (\Exception $e) {
            // Optionally log the exception and rethrow if needed
            throw new RegistrationException('Registration failed: ' . $e->getMessage(), 2006);
        }
    }
}
