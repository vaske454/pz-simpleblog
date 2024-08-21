<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;
use App\Service\LoginService;
use App\Exception\AuthenticationException;

class LoginController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        if ($this->loginService->isLoggedIn()) {
            header('Location: /');
            exit();
        }


        $errorMessage = null;
        $errorCode = null;

        try {
            if ($request->isPost()) {
                $username = trim($request->get('username'));
                $password = trim($request->get('password'));

                $result = $this->loginService->login($username, $password);
                if (isset($result['redirect'])) {
                    header('Location: ' . $result['redirect']);
                    exit();
                }
            }
        } catch (AuthenticationException $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
        }

        $title = 'Login - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/login.php', $title, ['error_message' => $errorMessage, 'error_code' => $errorCode]);

        return new Response($view->render());
    }
}
