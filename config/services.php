<?php

return [
    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // Protección anti-spam opcional del formulario de cotización/contacto.
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],

    // Número de WhatsApp comercial de NYG (confirmar el número real antes de publicar).
    'whatsapp' => [
        'number' => env('WHATSAPP_NUMBER', '5491130091907'),
    ],
];
