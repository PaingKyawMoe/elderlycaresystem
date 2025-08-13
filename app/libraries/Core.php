<?php



class Core
{
    // Default controller/method/params
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();

        // Get controller name from URL if exists and file found
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        $controllerName = $this->currentController;

        // Include controller file and instantiate
        require_once('../app/controllers/' . $controllerName . '.php');
        $this->currentController = $this->buildController($controllerName);


        // Get method from URL if exists and method exists
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        // Collect params
        $this->params = $url ? array_values($url) : [];

        // Build route key e.g. donations/donationdash (lowercase)
        $routeKey = strtolower($controllerName . '/' . $this->currentMethod);


        // Routes that should skip middleware
        $skipMiddlewareRoutes = [
            // 'pages/index',
            // 'pages/about',
            // 'pages/signin',
            // 'pages/register',
            // 'pages/donate',
        ];

        $middlewareMap = [
            'pages/dashboard' => ['AuthTokenMiddleware'],
            'pages/search' => ['AuthTokenMiddleware'],
            'pages/appointmentform' => ['AuthTokenMiddleware'],
            'pages/emplist' => ['AuthTokenMiddleware'],
            'pages/employee' => ['AuthTokenMiddleware'],
        ];


        // If current route is in skip list, directly call controller method (no middleware)
        if (in_array($routeKey, $skipMiddlewareRoutes)) {
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            return;
        }

        // Get middleware classes for current route, if any
        $middlewareClasses = $middlewareMap[$routeKey] ?? [];

        // Define the final callable (controller method with params)
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


    // Parse and sanitize URL
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
