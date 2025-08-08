<?php

// define url
class Core
{
    // App core class
    // create url & load controllers
    // URL method - /controller/method/params

    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();

        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
        }

        // Store the controller name string before instantiating the controller object
        $controllerName = $this->currentController;

        require_once('../app/controllers/' . $controllerName . '.php');

        $this->currentController = new $controllerName;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        // Build route key string like 'donations/donationdash'
        $routeKey = strtolower($controllerName . '/' . $this->currentMethod);

        // Define your middleware map: route => array of middleware class names
        $middlewareMap = [
            // Example route with middleware
            // 'donations/donationdash' => ['AuthTokenMiddleware'],
            // Add more routes here if needed
            // 'Donations/updatestatus' => ['LogMiddleware', 'AuthTokenMiddleware'],
        ];

        $middlewareClasses = $middlewareMap[$routeKey] ?? [];

        // Define the final controller action callable with params
        $finalAction = function () {
            return call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        };

        // Wrap each middleware around the finalAction
        foreach (array_reverse($middlewareClasses) as $middlewareClass) {
            require_once '../app/middlewares/' . $middlewareClass . '.php';

            $middleware = new $middlewareClass();

            $next = $finalAction;

            $finalAction = function () use ($middleware, $next) {
                return $middleware->handle($next);
            };
        }

        // Execute the middleware pipeline → controller method
        $finalAction();
    }

    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
