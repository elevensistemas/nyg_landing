<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\QuoteRequest;

class QuoteController {
    public function create(Request $request): string {
        return View::render('cotizacion', [
            'metaTitle' => 'Solicitar Cotización — NYG Transporte',
            'metaDescription' => 'Solicita un presupuesto a medida para tus necesidades de transporte y logística.'
        ]);
    }

    public function store(Request $request): void {
        $companyName = trim((string)$request->input('company_name'));
        $contactName = trim((string)$request->input('contact_name'));
        $email = trim((string)$request->input('email'));
        $phone = trim((string)$request->input('phone'));
        $originCity = trim((string)$request->input('origin_city'));
        $destinationCity = trim((string)$request->input('destination_city'));
        $cargoType = trim((string)$request->input('cargo_type'));

        if (empty($companyName) || empty($contactName) || empty($email) || empty($phone) || empty($originCity) || empty($destinationCity) || empty($cargoType)) {
            flash('error', 'Por favor completa todos los campos requeridos (*).');
            $_SESSION['_old'] = $request->all();
            Response::redirect('/cotizacion');
        }

        $id = QuoteRequest::create([
            'company_name' => $companyName,
            'contact_name' => $contactName,
            'email' => $email,
            'phone' => $phone,
            'origin_city' => $originCity,
            'destination_city' => $destinationCity,
            'cargo_type' => $cargoType,
            'cargo_weight' => $request->input('cargo_weight', ''),
            'cargo_volume' => $request->input('cargo_volume', ''),
            'frequency' => $request->input('frequency', ''),
            'comments' => $request->input('comments', ''),
        ]);

        // File upload handling
        $file = $request->file('attachment');
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/attachments/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = basename($file['name']);
            $targetPath = $uploadDir . time() . '_' . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                QuoteRequest::addAttachment($id, [
                    'file_name' => $fileName,
                    'file_path' => '/uploads/attachments/' . time() . '_' . $fileName,
                    'file_size' => $file['size'],
                    'file_type' => $file['type']
                ]);
            }
        }

        unset($_SESSION['_old']);
        Response::redirect('/cotizacion/gracias');
    }

    public function thanks(Request $request): string {
        return View::render('cotizacion-gracias', [
            'metaTitle' => 'Solicitud Recibida — NYG Transporte',
            'metaDescription' => 'Gracias por solicitar tu cotización con NYG Transporte.'
        ]);
    }
}
