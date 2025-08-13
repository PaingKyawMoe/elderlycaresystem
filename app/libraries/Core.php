<?php

class Core
{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();

        // Detect controller
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        $controllerName = $this->currentController;

        // Include & instantiate
        require_once('../app/controllers/' . $controllerName . '.php');
        $this->currentController = $this->buildController($controllerName);

        // Detect method
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        // Current route key
        $routeKey = strtolower($controllerName . '/' . $this->currentMethod);

        // Skip middleware for public pages
        $skipMiddlewareRoutes = [
            'pages/index',
            'pages/about',
            'pages/signin',
            'pages/register',
            'pages/donate',
        ];

        // Map routes to middleware
        $middlewareMap = [
            // User-only
            'pages/dashboard'       => ['AuthTokenMiddleware', ['RoleMiddleware', [User]]],
            'pages/search'          => ['AuthTokenMiddleware', ['RoleMiddleware', [User]]],
            'pages/appointmentform' => ['AuthTokenMiddleware', ['RoleMiddleware', [User]]],
            'pages/viewactivities' => ['AuthTokenMiddleware', ['RoleMiddleware', [User]]],

            // Admin-only
            'pages/emplist'         => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
            'pages/employee'        => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
            'donations/donationdash'        => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
            'users/userlist'        => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
            'appointment/list'        => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
            'pages/activities'        => ['AuthTokenMiddleware', ['RoleMiddleware', [Admin]]],
        ];

        // If route is in skip list → run directly
        if (in_array($routeKey, $skipMiddlewareRoutes)) {
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            return;
        }

        // Get middleware for this route
        $middlewareClasses = $middlewareMap[$routeKey] ?? [];

        // Final controller call
        $finalAction = function () {
            return call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        };

        // Wrap middleware
        foreach (array_reverse($middlewareClasses) as $middlewareItem) {
            // Check if middleware has parameters
            if (is_array($middlewareItem)) {
                $middlewareClass = $middlewareItem[0];
                $params = $middlewareItem[1] ?? [];
            } else {
                $middlewareClass = $middlewareItem;
                $params = [];
            }

            require_once '../app/middlewares/' . $middlewareClass . '.php';
            $middleware = new $middlewareClass();

            $next = $finalAction;

            $finalAction = function () use ($middleware, $next, $params) {
                return $middleware->handle($next, $params);
            };
        }


        // Execute controller with middleware
        $finalAction();
    }

    private function buildController(string $controllerName)
    {
        if ($controllerName === 'Donations') {
            $dbFile = '../app/libraries/Database.php';
            if (!file_exists($dbFile)) {
                die("Database file not found at $dbFile");
            }
            require_once $dbFile;
            if (!class_exists('Database')) {
                die("Database class does not exist after including $dbFile");
            }
            $db = new Database();

            require_once '../app/repositories/DonationRepository.php';
            require_once '../app/services/DonationService.php';

            $repository = new DonationRepository($db);
            $service = new DonationService($repository);

            return new Donations($service);
        }

        return new $controllerName();
    }

    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
