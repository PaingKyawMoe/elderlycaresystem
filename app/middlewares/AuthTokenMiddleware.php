<?php
require_once '../app/interfaces/MiddlewareInterface.php';

class AuthTokenMiddleware implements MiddlewareInterface
{
    public function handle(callable $next)
    {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // If user is not logged in, redirect
        if (!isset($_SESSION['user'])) {
            redirect('pages/signin');
            exit;
        }

        // Allow request to proceed
        return $next();
    }
}
