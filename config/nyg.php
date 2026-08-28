<?php

// Configuración específica de NYG Transporte, separada del resto del framework
// para que el contenido de negocio no se mezcle con configuración técnica.

return [
    /*
     * Datos de contacto por defecto, usados como fallback si la tabla `settings`
     * todavía no fue completada desde el panel administrativo.
     */
    'contacto' => [
        'email' => 'info@nygtransporte.com.ar',
        'telefono_visible' => '+54 9 11 7063 9810',
        'whatsapp' => env('WHATSAPP_NUMBER', '5491130091907'),
        'direccion' => 'Blanco Encalada 1362, 2° 6°, Villa Madero, Buenos Aires',
        'rnpsp' => '1117',
        'facebook' => 'https://www.facebook.com/nygtransporteok/',
        'instagram' => 'https://www.instagram.com/nyg_transporte/',
        'operando_desde' => 2018,
    ],

    // Cantidad de resultados por página en listados administrativos.
    'admin_per_page' => 15,

    // Tamaño máximo (KB) y tipos MIME permitidos para adjuntos del formulario de cotización.
    'quote_attachment' => [
        'max_kb' => 5120,
        'mimes' => ['pdf', 'jpg', 'jpeg', 'png', 'xlsx', 'xls', 'doc', 'docx'],
    ],
];
