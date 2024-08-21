<?php

namespace App\Controller;

use App\Http\Request;
use App\Service\LogoutService;
use App\Exception\SessionException;

class LogoutController
{
    private $logoutService;

    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function logout(Request $request)
    {
        try {
            if ($this->logoutService->isLoggedIn()) {
                $this->logoutService->logout();
            }
            header('Location: /');
            exit();
        } catch (SessionException $e) {
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
            header('Location: /error');
            exit();
        }
    }
}
