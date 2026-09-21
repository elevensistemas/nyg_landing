<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!empty($_SESSION['admin_user'])) {
            \Flight::redirect(route('admin.dashboard'));
            return;
        }

        \Flight::render('admin/auth/login');
    }

    public function login()
    {
        $data = \Flight::request()->data;
        $errors = [];

        $email = trim($data->email ?? '');
        $password = trim($data->password ?? '');

        if (empty($email)) {
            $errors[] = 'Ingresá tu correo electrónico.';
        }
        if (empty($password)) {
            $errors[] = 'Ingresá tu contraseña.';
        }

        if (empty($errors)) {
            $user = User::findByEmail($email);
            if ($user && User::verifyPassword($password, $user['password'])) {
                if (!empty($user['is_admin'])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['admin_user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email']
                    ];
                    \Flight::redirect(route('admin.dashboard'));
                    return;
                } else {
                    $errors[] = 'Este usuario no tiene permisos de administrador.';
                }
            } else {
                $errors[] = 'Las credenciales no coinciden con ningún administrador.';
            }
        }

        $_SESSION['_errors'] = $errors;
        $_SESSION['_old'] = ['email' => $email];
        \Flight::redirect(route('admin.login'));
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin_user']);
        session_destroy();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['_token']);
        \Flight::redirect(route('admin.login'));
    }
}
