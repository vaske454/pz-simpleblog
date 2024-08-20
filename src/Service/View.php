<?php

namespace App\Service;

class View
{
    protected string $templatePath;
    protected ?string $title;
    protected array $data;

    public function __construct(string $templatePath, ?string $title = null, array $data = [])
    {
        $this->templatePath = $templatePath;
        $this->title = $title;
        $this->data = $data;
    }

    public function render(): string
    {
        $title = $this->title;
        extract($this->data);
        ob_start();
        include $this->templatePath;
        return ob_get_clean();
    }
}
