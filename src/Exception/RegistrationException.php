<?php

namespace App\Exception;

use Exception;

class RegistrationException extends Exception
{
    public function __construct($message = "Registration failed", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
