<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use Core\Auth;

class AuthController {
    public function showLogin(Request $request): string {
        return View::render('admin.auth.login', [
            'metaTitle' => 'Iniciar Sesión — Panel Administrativo NYG'
        ], 'layouts/admin');
    }

    public function login(Request $request): void {
        $email = trim((string)$request->input('email'));
        $password = trim((string)$request->input('password'));

        if (Auth::attempt($email, $password)) {
            flash('success', '¡Bienvenido al Panel Administrativo!');
            Response::redirect('/admin');
        } else {
            flash('error', 'Credenciales incorrectas. Por favor verifica tu email y contraseña.');
            Response::redirect('/admin/login');
        }
    }

    public function logout(Request $request): void {
        Auth::logout();
        flash('success', 'Has cerrado sesión correctamente.');
        Response::redirect('/admin/login');
    }
}
