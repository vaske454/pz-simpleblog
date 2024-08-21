<?php

namespace App\Http;

class Response
{
    protected $content;

    public function __construct($content = '')
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
