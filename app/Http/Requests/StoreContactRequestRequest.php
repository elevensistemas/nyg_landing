<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:3000'],
            // Honeypot: campo oculto para el usuario, si llega con valor es un bot.
            'website' => ['prohibited'],
            'privacy_consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ingresá tu nombre.',
            'email.required' => 'Ingresá un correo electrónico.',
            'email.email' => 'El correo electrónico no es válido.',
            'message.required' => 'Contanos brevemente tu consulta.',
            'privacy_consent.accepted' => 'Necesitamos tu consentimiento para procesar los datos enviados.',
        ];
    }
}
