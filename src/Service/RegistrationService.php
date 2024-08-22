<?php

namespace App\Service;

use App\Model\User;
use App\Exception\RegistrationException;

class RegistrationService
{
    public function __construct()
    {
        session_start();
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
        if (empty($username) && empty($password)) {
            throw new RegistrationException('Username and password cannot be empty', 2001);
        }

        if (empty($username)) {
            throw new RegistrationException('Username cannot be empty', 2002);
        }

        if (!$this->isValidUsername($username)) {
            throw new RegistrationException('Username must be 3-30 characters long and can only include letters, numbers, dots, underscores, and hyphens.', 2003);
        }

        if (empty($password)) {
            throw new RegistrationException('Password cannot be empty', 2004);
        }

        if (!$this->isValidPassword($password)) {
            throw new RegistrationException('Password must be 8-32 characters long, contain at least one uppercase letter, one number, and one special character.', 2005);
        }

        $user = User::create($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            return $user;
        } else {
            return null;
        }
    }
}
