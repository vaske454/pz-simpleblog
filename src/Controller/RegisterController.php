<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;
use App\Service\RegistrationService;
use App\Exception\RegistrationException;

class RegisterController
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(Request $request)
    {
        if ($this->registrationService->isLoggedIn()) {
            header('Location: /');
            exit();
        }

        $errorMessage = null;
        $errorCode = null;

        try {
            if ($request->isPost()) {
                $username = trim($request->get('username'));
                $password = trim($request->get('password'));

                $user = $this->registrationService->register($username, $password);
                if ($user) {
                    header('Location: /');
                    exit();
                }
            }
        } catch (RegistrationException $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            error_log("Error: " . $errorMessage . " Code: " . $errorCode);
        }

        $title = 'Register - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/register.php', $title, ['error_message' => $errorMessage, 'error_code' => $errorCode]);

        return new Response($view->render());
    }
}
