<?php

namespace moeinafshari\phpmvc;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $onlyView = $this->onlyView($view, $params);
        $layout = $this->layoutContent();

        return str_replace('{{content}}', $onlyView, $layout);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app?->controller?->layout ?? "main";
        ob_start();
        include_once Application::$ROOT_DIR ."/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    public function onlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR ."/views/{$view}.php";
        return ob_get_clean();
    }
}