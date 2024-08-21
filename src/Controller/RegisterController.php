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
//        var_dump($this->registrationService->isLoggedIn());die();
        if ($this->registrationService->isLoggedIn()) {
            header('Location: /');
            exit();
        }

        $error = null;

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
            $error = $e->getMessage();
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
        }

        $title = 'Register - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/register.php', $title, ['error' => $error]);

        return new Response($view->render());
    }
}
