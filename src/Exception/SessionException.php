<?php

namespace App\Exception;

use Exception;

class SessionException extends Exception
{
    public function __construct($message = "Session error", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
