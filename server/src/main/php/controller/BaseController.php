<?php

class BaseController
{

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function getUserId()
    {
        return $_COOKIE['user'];
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'web/views/' . $template . '.php';
        $output = 'File not foundd';

        if (file_exists($templatePath)) {
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}