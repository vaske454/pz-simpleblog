<?php

namespace App\View;

class View
{
    protected $templatePath;
    protected $title;
    protected $data;

    public function __construct($templatePath, $title = null, $data = [])
    {
        $this->templatePath = $templatePath;
        $this->title = $title;
        $this->data = $data;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function render()
    {
        $title = $this->title;
        extract($this->data);
        ob_start();
        include $this->templatePath;
        return ob_get_clean();
    }
}
