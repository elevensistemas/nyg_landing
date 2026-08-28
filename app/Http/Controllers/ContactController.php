<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequestReceived;
use App\Models\ContactRequest;
use App\Http\Requests\StoreContactRequestRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacto');
    }

    public function store(StoreContactRequestRequest $request)
    {
        $data = $request->validated();
        unset($data['website'], $data['privacy_consent']);

        $contactRequest = ContactRequest::create(array_merge($data, [
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]));

        try {
            Mail::to(config('mail.notify_address'))->send(new ContactRequestReceived($contactRequest));
        } catch (\Throwable $e) {
            // El formulario nunca debe fallar para el usuario por un problema de SMTP;
            // la consulta ya quedó guardada en la base de datos. Se registra el error
            // sin exponer datos sensibles del remitente.
            Log::error('No se pudo enviar el correo de consulta de contacto: '.$e->getMessage());
        }

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('contacto')->with('success', 'Gracias por escribirnos. Te vamos a responder a la brevedad.');
    }
}
