<?php
// ------------------------------------
// Security hardening: session settings
// ------------------------------------
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
]);

// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("Referrer-Policy: strict-origin-when-cross-origin");

// ------------------------------------
// App bootstrap
// ------------------------------------
require_once '../app/class_loader.php';
session_start();
// DO NOT start the session here
// You will call session_start() only inside controllers/views where needed

$init = new Core();
