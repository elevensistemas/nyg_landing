<?php

namespace App\Controllers;

use App\Models\ContactRequest;
use App\Helpers\Mail;

class ContactController extends Controller
{
    public function create()
    {
        $this->render('contacto');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $errors = [];

        // Honeypot anti-spam
        if (!empty($data->website)) {
            // Silently succeed
            $this->json(['ok' => true]);
            return;
        }

        // Validate name
        if (empty($data->name) || trim($data->name) === '') {
            $errors['name'] = 'Ingresá tu nombre.';
        } elseif (strlen($data->name) > 150) {
            $errors['name'] = 'El nombre no puede tener más de 150 caracteres.';
        }

        // Validate email
        if (empty($data->email) || trim($data->email) === '') {
            $errors['email'] = 'Ingresá un correo electrónico.';
        } elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El correo electrónico no es válido.';
        } elseif (strlen($data->email) > 150) {
            $errors['email'] = 'El correo electrónico no puede tener más de 150 caracteres.';
        }

        // Validate message
        if (empty($data->message) || trim($data->message) === '') {
            $errors['message'] = 'Contanos brevemente tu consulta.';
        } elseif (strlen($data->message) > 3000) {
            $errors['message'] = 'El mensaje no puede tener más de 3000 caracteres.';
        }

        // Validate phone
        if (!empty($data->phone) && strlen($data->phone) > 60) {
            $errors['phone'] = 'El teléfono no puede tener más de 60 caracteres.';
        }

        // Validate consent
        if (empty($data->privacy_consent)) {
            $errors['privacy_consent'] = 'Necesitamos tu consentimiento para procesar los datos enviados.';
        }

        if (!empty($errors)) {
            if (\Flight::request()->ajax || strpos(\Flight::request()->headers['Accept'] ?? '', 'application/json') !== false) {
                $this->json(['errors' => $errors], 422);
                return;
            }

            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'message' => $data->message,
            ];
            \Flight::redirect(route('contacto'));
            return;
        }

        $id = ContactRequest::create([
            'name' => trim($data->name),
            'email' => trim($data->email),
            'phone' => !empty($data->phone) ? trim($data->phone) : null,
            'message' => trim($data->message),
            'ip_address' => \Flight::request()->ip,
            'user_agent' => substr((string)\Flight::request()->user_agent, 0, 255),
            'status' => 'nueva'
        ]);

        // Registrar conversión en el medidor de visitas
        \App\Helpers\Tracker::markFormSubmitted('Contacto', $id);

        $contactRequest = ContactRequest::find($id);

        try {
            $to = $_ENV['MAIL_NOTIFY_ADDRESS'] ?? 'info@nygtransporte.com.ar';
            $subject = 'Nueva consulta desde el sitio web';
            $body = "<h2>Nueva consulta desde el sitio web</h2>
                     <p><strong>Nombre:</strong> " . htmlspecialchars($contactRequest['name']) . "</p>
                     <p><strong>Correo:</strong> " . htmlspecialchars($contactRequest['email']) . "</p>";
            if ($contactRequest['phone']) {
                $body .= "<p><strong>Teléfono:</strong> " . htmlspecialchars($contactRequest['phone']) . "</p>";
            }
            $body .= "<p><strong>Mensaje:</strong><br>" . nl2br(htmlspecialchars($contactRequest['message'])) . "</p>";
            
            $adminUrl = rtrim($_ENV['APP_URL'] ?? '', '/') . '/admin/contact-requests/' . $contactRequest['id'];
            $body .= "<div style='margin: 30px 0; text-align: center;'>
                        <a href='$adminUrl' class='btn' style='background-color:#fbbf24; color:#111827; text-decoration:none; padding:12px 24px; font-weight:bold; border-radius:6px; display:inline-block;'>Ver en el panel</a>
                      </div>";

            Mail::send($to, $subject, $body);
        } catch (\Throwable $e) {
            error_log("Error sending contact notification mail: " . $e->getMessage());
        }

        if (\Flight::request()->ajax || strpos(\Flight::request()->headers['Accept'] ?? '', 'application/json') !== false) {
            $this->json(['ok' => true]);
            return;
        }

        $_SESSION['success'] = 'Gracias por escribirnos. Te vamos a responder a la brevedad.';
        \Flight::redirect(route('contacto'));
    }
}
