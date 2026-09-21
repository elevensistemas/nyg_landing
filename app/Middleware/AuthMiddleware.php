<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function before(): void
    {
        self::check();
    }

    public static function check(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['admin_user'])) {
            \Flight::redirect(\route('admin.login'));
            \Flight::stop();
        }
    }
}
