<?php

namespace App\Http;

class Request
{
    protected $parameters;

    public function __construct()
    {
        $this->parameters = array_merge($_POST, $_GET);
    }

    public function get($name, $default = null)
    {
        return isset($this->parameters[$name]) ? htmlspecialchars($this->parameters[$name], ENT_QUOTES, 'UTF-8') : $default;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getPath()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

}
