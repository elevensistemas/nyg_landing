<?php

namespace App\Controllers;

use App\Models\QuoteRequest;
use App\Models\Service;
use App\Helpers\Mail;

class QuoteController extends Controller
{
    public function create()
    {
        $services = Service::published();
        $this->render('cotizacion', compact('services'));
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $errors = [];

        // Honeypot anti-spam
        if (!empty($data->website)) {
            $this->json(['ok' => true]);
            return;
        }

        // Validate basic inputs
        if (empty($data->full_name) || trim($data->full_name) === '') {
            $errors['full_name'] = 'Ingresá tu nombre y apellido.';
        }
        if (empty($data->email) || trim($data->email) === '') {
            $errors['email'] = 'Ingresá un correo electrónico.';
        } elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El correo electrónico no es válido.';
        }
        if (empty($data->phone) || trim($data->phone) === '') {
            $errors['phone'] = 'Ingresá un teléfono de contacto.';
        }
        if (empty($data->privacy_consent)) {
            $errors['privacy_consent'] = 'Necesitamos tu consentimiento para procesar los datos enviados.';
        }
        
        // Date check
        if (!empty($data->estimated_date)) {
            $today = date('Y-m-d');
            if ($data->estimated_date < $today) {
                $errors['estimated_date'] = 'La fecha estimada no puede ser anterior a hoy.';
            }
        }

        // Attachment check
        $hasFile = false;
        $file = null;
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['attachment'];
            $hasFile = true;
            
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors['attachment'] = 'Hubo un error al subir el archivo.';
            } elseif ($file['size'] > 5242880) { // 5MB
                $errors['attachment'] = 'El archivo adjunto no puede superar los 5 MB.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'xlsx', 'xls', 'doc', 'docx'];
                if (!in_array($ext, $allowed)) {
                    $errors['attachment'] = 'Formato de archivo no permitido.';
                }
            }
        }

        if (!empty($errors)) {
            if (\Flight::request()->ajax || strpos(\Flight::request()->headers['Accept'] ?? '', 'application/json') !== false) {
                $this->json(['errors' => $errors], 422);
                return;
            }

            $_SESSION['_errors'] = $errors;
            $_SESSION['_old'] = (array)$data;
            \Flight::redirect(route('cotizacion'));
            return;
        }

        // Create DB record
        $quoteId = QuoteRequest::create([
            'full_name' => trim($data->full_name),
            'company' => !empty($data->company) ? trim($data->company) : null,
            'email' => trim($data->email),
            'phone' => trim($data->phone),
            'service_id' => !empty($data->service_id) ? (int)$data->service_id : null,
            'service_type_other' => !empty($data->service_type_other) ? trim($data->service_type_other) : null,
            'origin' => !empty($data->origin) ? trim($data->origin) : null,
            'destination' => !empty($data->destination) ? trim($data->destination) : null,
            'cargo_type' => !empty($data->cargo_type) ? trim($data->cargo_type) : null,
            'requires_temperature_control' => !empty($data->requires_temperature_control) ? 1 : 0,
            'temperature_requirement' => !empty($data->temperature_requirement) ? trim($data->temperature_requirement) : null,
            'approx_weight_kg' => !empty($data->approx_weight_kg) ? (float)$data->approx_weight_kg : null,
            'approx_volume_m3' => !empty($data->approx_volume_m3) ? (float)$data->approx_volume_m3 : null,
            'pallets_or_packages' => !empty($data->pallets_or_packages) ? (int)$data->pallets_or_packages : null,
            'frequency' => !empty($data->frequency) ? trim($data->frequency) : null,
            'estimated_date' => !empty($data->estimated_date) ? $data->estimated_date : null,
            'comments' => !empty($data->comments) ? trim($data->comments) : null,
            'ip_address' => \Flight::request()->ip,
            'user_agent' => substr((string)\Flight::request()->user_agent, 0, 255),
            'status' => 'nueva'
        ]);

        // Registrar conversión en el medidor de visitas
        \App\Helpers\Tracker::markFormSubmitted('Cotización', $quoteId);

        $quote = QuoteRequest::find($quoteId);
        $mailAttachments = [];

        // Upload file
        if ($hasFile && $file) {
            $destDir = __DIR__ . '/../../public/storage/quotes/' . $quoteId;
            if (!is_dir($destDir)) {
                mkdir($destDir, 0755, true);
            }
            $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
            $destPath = $destDir . '/' . $cleanName;
            
            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $relativePath = 'quotes/' . $quoteId . '/' . $cleanName;
                QuoteRequest::addAttachment($quoteId, [
                    'original_name' => $file['name'],
                    'path' => $relativePath,
                    'mime_type' => $file['type'],
                    'size_bytes' => $file['size'],
                ]);
                $mailAttachments[] = [
                    'path' => $destPath,
                    'name' => $file['name']
                ];
            }
        }

        // Send Email Notifications
        try {
            $notifyEmail = $_ENV['MAIL_NOTIFY_ADDRESS'] ?? 'info@nygtransporte.com.ar';
            
            // Mail to Admin
            $subjectAdmin = 'Nueva solicitud de cotización';
            $bodyAdmin = "<h2>Nueva solicitud de cotización</h2>";
            $bodyAdmin .= "<p><strong>Nombre:</strong> " . htmlspecialchars($quote['full_name']) . "</p>";
            if ($quote['company']) {
                $bodyAdmin .= "<p><strong>Empresa:</strong> " . htmlspecialchars($quote['company']) . "</p>";
            }
            $bodyAdmin .= "<p><strong>Correo:</strong> " . htmlspecialchars($quote['email']) . "</p>";
            $bodyAdmin .= "<p><strong>Teléfono:</strong> " . htmlspecialchars($quote['phone']) . "</p>";
            
            $serviceName = $quote['service_name'] ?? $quote['service_type_other'] ?? 'No especificado';
            $bodyAdmin .= "<p><strong>Servicio:</strong> " . htmlspecialchars($serviceName) . "</p>";
            
            if ($quote['origin'] || $quote['destination']) {
                $bodyAdmin .= "<p><strong>Origen / Destino:</strong> " . htmlspecialchars($quote['origin'] ?? '—') . " &rarr; " . htmlspecialchars($quote['destination'] ?? '—') . "</p>";
            }
            if ($quote['cargo_type']) {
                $bodyAdmin .= "<p><strong>Tipo de mercadería:</strong> " . htmlspecialchars($quote['cargo_type']) . "</p>";
            }
            if ($quote['requires_temperature_control']) {
                $bodyAdmin .= "<p><strong>Requiere temperatura controlada:</strong> Sí (" . htmlspecialchars($quote['temperature_requirement'] ?? 'sin especificar') . ")</p>";
            }
            if ($quote['approx_weight_kg']) {
                $bodyAdmin .= "<p><strong>Peso aproximado:</strong> " . htmlspecialchars($quote['approx_weight_kg']) . " kg</p>";
            }
            if ($quote['approx_volume_m3']) {
                $bodyAdmin .= "<p><strong>Volumen aproximado:</strong> " . htmlspecialchars($quote['approx_volume_m3']) . " m³</p>";
            }
            if ($quote['pallets_or_packages']) {
                $bodyAdmin .= "<p><strong>Pallets / bultos:</strong> " . htmlspecialchars($quote['pallets_or_packages']) . "</p>";
            }
            if ($quote['frequency']) {
                $bodyAdmin .= "<p><strong>Frecuencia:</strong> " . htmlspecialchars($quote['frequency']) . "</p>";
            }
            if ($quote['estimated_date']) {
                $bodyAdmin .= "<p><strong>Fecha estimada:</strong> " . date('d/m/Y', strtotime($quote['estimated_date'])) . "</p>";
            }
            if ($quote['comments']) {
                $bodyAdmin .= "<p><strong>Comentarios:</strong><br>" . nl2br(htmlspecialchars($quote['comments'])) . "</p>";
            }
            
            $adminUrl = rtrim($_ENV['APP_URL'] ?? '', '/') . '/admin/quote-requests/' . $quote['id'];
            $bodyAdmin .= "<div style='margin: 30px 0; text-align: center;'>
                            <a href='$adminUrl' class='btn' style='background-color:#fbbf24; color:#111827; text-decoration:none; padding:12px 24px; font-weight:bold; border-radius:6px; display:inline-block;'>Ver en el panel</a>
                          </div>";

            Mail::send($notifyEmail, $subjectAdmin, $bodyAdmin, $mailAttachments);

            // Mail to Client (Confirmation)
            $firstName = explode(' ', $quote['full_name'])[0];
            $subjectClient = "Recibimos tu solicitud, $firstName";
            $bodyClient = "<h2>Recibimos tu solicitud, $firstName</h2>
                           <p>Gracias por escribirnos. Un integrante de nuestro equipo va a revisar los datos de tu operación y te va a contactar a la brevedad para avanzar con la propuesta.</p>
                           <p><strong>Resumen de tu solicitud:</strong></p>
                           <ul>
                               <li>Servicio: " . htmlspecialchars($serviceName) . "</li>";
            if ($quote['origin'] || $quote['destination']) {
                $bodyClient .= "<li>Origen / destino: " . htmlspecialchars($quote['origin'] ?? '—') . " &rarr; " . htmlspecialchars($quote['destination'] ?? '—') . "</li>";
            }
            if ($quote['estimated_date']) {
                $bodyClient .= "<li>Fecha estimada: " . date('d/m/Y', strtotime($quote['estimated_date'])) . "</li>";
            }
            $bodyClient .= "</ul>
                           <p>Si necesitás una respuesta más rápida, también podés escribirnos por WhatsApp.</p>
                           <p>Saludos,<br><strong>NYG Transporte</strong></p>";

            Mail::send($quote['email'], $subjectClient, $bodyClient);

        } catch (\Throwable $e) {
            error_log("Error sending quote request emails: " . $e->getMessage());
        }

        if (\Flight::request()->ajax || strpos(\Flight::request()->headers['Accept'] ?? '', 'application/json') !== false) {
            $this->json(['ok' => true]);
            return;
        }

        \Flight::redirect(route('cotizacion.gracias'));
    }

    public function thanks()
    {
        $this->render('cotizacion-gracias');
    }
}
