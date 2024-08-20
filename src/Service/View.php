<?php

namespace App\Service;

class View
{
    protected string $templatePath;
    protected array $data;

    public function __construct(string $templatePath, array $data = [])
    {
        $this->templatePath = $templatePath;
        $this->data = $data;
    }

    public function render(): string
    {
        extract($this->data);
        ob_start();
        include $this->templatePath;
        return ob_get_clean();
    }
}
