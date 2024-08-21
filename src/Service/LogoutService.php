<?php

namespace App\Service;

use App\Exception\SessionException;

class LogoutService
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
     * @throws SessionException
     */
    public function logout()
    {
        if (!$this->isLoggedIn()) {
            throw new SessionException('No active session to logout.', 3001);
        }

        session_unset();
        session_destroy();
    }
}
