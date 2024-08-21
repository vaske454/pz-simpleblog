<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\View;
use App\Model\User;
use App\Exception\AuthenticationException;
use App\Exception\RegistrationException;
use App\Exception\SessionException;

class AuthController
{
    public function __construct()
    {
        // Start the session for all requests to the controller
        session_start();
    }

    private function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function login(Request $request)
    {
        if ($this->isLoggedIn()) {
            // If user is already logged in, redirect to homepage
            header('Location: /');
            exit();
        }

        $error = null;

        try {
            if ($request->isPost()) {
                $username = trim($request->get('username'));
                $password = trim($request->get('password'));

                $user = User::authenticate($username, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                    exit();
                } else {
                    throw new AuthenticationException('Invalid username or password', 401);
                }
            }
        } catch (AuthenticationException $e) {
            $error = $e->getMessage();
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
        }

        $title = 'Login - My Blog';
        $view = new View(__DIR__ . '/../../templates/pages/login.php', $title, ['error' => $error]);

        return new Response($view->render());
    }

    public function register(Request $request)
    {
        if ($this->isLoggedIn()) {
            header('Location: /');
            exit();
        }

        $error = null;

        try {
            if ($request->isPost()) {
                $username = trim($request->get('username'));
                $password = trim($request->get('password'));

                // Validate username length
                if (strlen($username) > 30) { // Example max length
                    throw new RegistrationException('Username cannot be longer than 30 characters.', 400);
                }

                // Validate password complexity
                if (!$this->isValidPassword($password)) {
                    throw new RegistrationException('Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.', 400);
                }

                $user = User::create($username, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                    exit();
                } else {
                    throw new RegistrationException('Registration failed', 500);
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

    private function isValidPassword($password)
    {
        // Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        return preg_match($pattern, $password);
    }


    public function logout()
    {
        try {
            if (!$this->isLoggedIn()) {
                throw new SessionException('No active session to logout.');
            }

            session_unset();
            session_destroy();
            header('Location: /');
            exit();
        } catch (SessionException $e) {
            error_log("Error: " . $e->getMessage() . " Code: " . $e->getCode());
            header('Location: /');
            exit();
        }
    }
}
