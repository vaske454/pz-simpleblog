<?php

namespace App\Controller;

use App\Http\Request;
use App\Services\LogoutService;
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
            // Get the referrer URL or use the current URL if referrer is not available
            $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';

            // Check if the referrer URL contains "single-product" (or any indicator for single product page)
            if (strpos($referrer, 'single-product') === false) {
                // Redirect to the referrer page
                header('Location: ' . $referrer);
            } else {
                // Redirect to the homepage if the referrer indicates a single product page
                header('Location: /');
            }
            exit();
        } catch (SessionException $e) {
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
            header('Location: /error');
            exit();
        }
    }
}
