<?php

namespace App\Http;

class Request
{
    protected array $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function get($name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }

    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}