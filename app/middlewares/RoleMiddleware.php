<?php
class RoleMiddleware
{
    public function handle($next, $allowedRoles = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Make sure allowedRoles is always an array
        if (!is_array($allowedRoles)) {
            $allowedRoles = [$allowedRoles];
        }

        // If no role set in session → redirect to login
        if (!isset($_SESSION['user_role'])) {
            header("Location: " . URLROOT . "/pages/signin");
            exit;
        }

        // Role not allowed
        if (!in_array($_SESSION['user_role'], $allowedRoles)) {
            header("Location: " . URLROOT . "/pages/signin");
            exit;
        }

        return $next();
    }
}
