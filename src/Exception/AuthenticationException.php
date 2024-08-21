<?php

namespace App\Exception;

use Exception;

class AuthenticationException extends Exception
{
    public function __construct($message = "Authentication failed", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
