<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\ContactRequest;

class ContactController {
    public function create(Request $request): string {
        return View::render('contacto', [
            'metaTitle' => 'Contacto — NYG Transporte',
            'metaDescription' => 'Ponte en contacto con nuestro equipo comercial y operativo de NYG Transporte.'
        ]);
    }

    public function store(Request $request): void {
        $name = trim((string)$request->input('name'));
        $email = trim((string)$request->input('email'));
        $message = trim((string)$request->input('message'));

        if (empty($name) || empty($email) || empty($message)) {
            flash('error', 'Por favor completa todos los campos requeridos.');
            $_SESSION['_old'] = $request->all();
            Response::redirect('/contacto');
        }

        ContactRequest::create([
            'name' => $name,
            'email' => $email,
            'phone' => $request->input('phone', ''),
            'company' => $request->input('company', ''),
            'subject' => $request->input('subject', ''),
            'message' => $message
        ]);

        unset($_SESSION['_old']);
        flash('success', '¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.');
        Response::redirect('/contacto');
    }
}
