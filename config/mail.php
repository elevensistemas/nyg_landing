<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 587),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],
        'array' => [
            'transport' => 'array',
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'info@nygtransporte.com.ar'),
        'name' => env('MAIL_FROM_NAME', 'NYG Transporte'),
    ],

    // Correo interno que recibe copia de cada consulta de contacto y cotización.
    'notify_address' => env('MAIL_NOTIFY_ADDRESS', 'info@nygtransporte.com.ar, mariano.caiban@nygtransporte.com.ar, franco.gradilone@nygtransporte.com.ar'),
];
