<?php

namespace App\Http;

class Request
{
    protected $parameters;

    public function __construct($parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function get($name, $default = null)
    {
        return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
    }

    public function getPath()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
