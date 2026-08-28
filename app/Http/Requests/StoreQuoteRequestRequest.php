<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Solo los datos mínimos de contacto son obligatorios. El resto de los
     * campos operativos son opcionales, tal como pide el brief: no forzar
     * al visitante a completar todo para poder enviar la consulta.
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'company' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:60'],

            'service_id' => ['nullable', 'exists:services,id'],
            'service_type_other' => ['nullable', 'string', 'max:150'],
            'origin' => ['nullable', 'string', 'max:150'],
            'destination' => ['nullable', 'string', 'max:150'],
            'cargo_type' => ['nullable', 'string', 'max:150'],
            'requires_temperature_control' => ['nullable', 'boolean'],
            'temperature_requirement' => ['nullable', 'string', 'max:100'],
            'approx_weight_kg' => ['nullable', 'numeric', 'min:0', 'max:999999'],
            'approx_volume_m3' => ['nullable', 'numeric', 'min:0', 'max:999999'],
            'pallets_or_packages' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'frequency' => ['nullable', 'string', 'max:100'],
            'estimated_date' => ['nullable', 'date', 'after_or_equal:today'],
            'comments' => ['nullable', 'string', 'max:3000'],

            'attachment' => [
                'nullable', 'file', 'max:5120',
                'mimes:pdf,jpg,jpeg,png,xlsx,xls,doc,docx',
            ],

            // Honeypot anti-spam.
            'website' => ['prohibited'],
            'privacy_consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Ingresá tu nombre y apellido.',
            'email.required' => 'Ingresá un correo electrónico.',
            'email.email' => 'El correo electrónico no es válido.',
            'phone.required' => 'Ingresá un teléfono de contacto.',
            'attachment.max' => 'El archivo adjunto no puede superar los 5 MB.',
            'attachment.mimes' => 'Formato de archivo no permitido.',
            'estimated_date.after_or_equal' => 'La fecha estimada no puede ser anterior a hoy.',
            'privacy_consent.accepted' => 'Necesitamos tu consentimiento para procesar los datos enviados.',
        ];
    }
}
