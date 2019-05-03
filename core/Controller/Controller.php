<?php

namespace Core\Controller;

//TODO: document all functions
class Controller
{
    protected $viewPath;
    protected $template;

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require $this->viewPath . 'templates/' . $this->template . '.php';
    }

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Access denied');
    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }
}
