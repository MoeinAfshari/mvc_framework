<?php

namespace moeinafshari\phpmvc;

use moeinafshari\phpmvc\exception\NotFoundException;

class Router
{
    protected Request $request;
    protected Response $response;
    protected array $routes = [];

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback == false)
        {
            throw new NotFoundException();
        }

        if(is_string($callback))
        {
            return Application::$app->view->renderView($callback);
        }

        if(is_array($callback))
        {
            /** @var \moeinafshari\phpmvc\Controller $controller */
             $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}