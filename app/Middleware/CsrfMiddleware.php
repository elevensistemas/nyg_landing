<?php

namespace App\Middleware;

class CsrfMiddleware
{
    public static function check(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
            if (!$token || $token !== ($_SESSION['_token'] ?? null)) {
                \Flight::halt(419, 'CSRF token mismatch. Page expired.');
                exit;
            }
        }
    }
}
