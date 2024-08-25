<?php

namespace App\Exception;

use Exception;

class BlogPostException extends Exception
{
    public function __construct($message = "Blog Post failed", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
