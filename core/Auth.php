<?php

namespace Core;

use App\Models\User;

class Auth {
    public static function attempt(string $email, string $password): bool {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                @session_start();
            }
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_user_name'] = $user['name'] ?? $user['email'];
            return true;
        }
        return false;
    }

    public static function check(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        return isset($_SESSION['admin_user_id']);
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }
        return User::find($_SESSION['admin_user_id']);
    }

    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        unset($_SESSION['admin_user_id'], $_SESSION['admin_user_name']);
    }
}
