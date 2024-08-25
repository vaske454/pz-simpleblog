<?php

namespace App\Exception;

use Exception;

class AuthorizationException extends Exception
{
    public function __construct($message = "Authorization failed", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
