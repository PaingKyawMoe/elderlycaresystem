<?php
require_once '../app/interfaces/MiddlewareInterface.php';

class AuthTokenMiddleware implements MiddlewareInterface
{
    public function handle(callable $next)
    {
        $headers = getallheaders(); 
        $token = $headers['Authorization'] ?? '';

        if ($token !== 'Bearer my-secret-token') {
            http_response_code(401);
            header('Location: /pages/index'); // or your chosen page
            exit();; // stops middleware pipeline and controller call
        }

        // proceed to next middleware or controller
        return $next();
    }
}
