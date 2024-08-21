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
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        return preg_match($pattern, $password);
    }

    /**
     * @throws RegistrationException
     */
    public function register($username, $password)
    {
        if (strlen($username) > 30) {
            throw new RegistrationException('Username cannot be longer than 30 characters.', 2001);
        }

        if (!$this->isValidPassword($password)) {
            throw new RegistrationException('Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.', 2002);
        }

        $user = User::create($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            return $user;
        } else {
            throw new RegistrationException('Registration failed', 2003);
        }
    }
}
