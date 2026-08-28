<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Preguntas frecuentes con respuestas prudentes: no se fijan condiciones
     * comerciales (precios, plazos exactos) que no estén confirmadas.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => '¿Qué zonas cubre NYG Transporte?',
                'answer' => 'Coordinamos operaciones de transporte y distribución según cada solicitud. Contanos tu origen y destino desde el formulario de cotización y te confirmamos la cobertura para tu operación puntual.',
                'category' => 'Cobertura',
            ],
            [
                'question' => '¿Qué tipos de mercadería pueden transportar?',
                'answer' => 'Trabajamos con distintos tipos de carga, incluyendo mercadería que requiere temperatura controlada (congelada y supercongelada). Indicá el tipo de producto en el formulario para que evaluemos la unidad adecuada.',
                'category' => 'Mercadería',
            ],
            [
                'question' => '¿Tienen transporte con temperatura controlada?',
                'answer' => 'Sí, disponemos de unidades equipadas para carga congelada y supercongelada, que cumplen con los requerimientos de frío según el tipo de producto.',
                'category' => 'Temperatura controlada',
            ],
            [
                'question' => '¿Cómo puedo hacer seguimiento de mi envío?',
                'answer' => 'Nuestras unidades cuentan con sistemas de seguimiento satelital con recupero. Durante la operación mantenemos informado al cliente sobre el estado de su envío.',
                'category' => 'Seguimiento',
            ],
            [
                'question' => '¿Ofrecen servicio de almacenamiento?',
                'answer' => 'Sí. Recepcionamos, clasificamos y almacenamos la mercadería en nuestros depósitos, y luego realizamos la preparación y el despacho de los envíos.',
                'category' => 'Almacenamiento',
            ],
            [
                'question' => '¿Cómo solicito una cotización?',
                'answer' => 'Completá el formulario de cotización con los datos de tu operación (origen, destino, tipo de mercadería, volumen aproximado) o escribinos directamente por WhatsApp. Te respondemos a la brevedad.',
                'category' => 'Cotizaciones',
            ],
            [
                'question' => '¿Cuál es el tiempo de respuesta a una consulta?',
                'answer' => 'Respondemos las consultas a la brevedad. El tiempo exacto puede variar según la complejidad de la operación consultada.',
                'category' => 'Tiempos de respuesta',
            ],
            [
                'question' => '¿Qué documentación necesito para una operación de comercio exterior?',
                'answer' => 'La documentación varía según el tipo de operación de importación o exportación. Consultanos los detalles de tu caso puntual para indicarte qué necesitás.',
                'category' => 'Documentación',
            ],
            [
                'question' => '¿Realizan transporte de cargas completas?',
                'answer' => 'Sí, coordinamos el traslado de cargas completas evaluando el volumen, el tipo de mercadería y el destino de cada operación.',
                'category' => 'Cargas completas',
            ],
            [
                'question' => '¿Pueden coordinar operaciones programadas o recurrentes?',
                'answer' => 'Sí. Indicá la frecuencia estimada en el formulario de cotización (única vez, semanal, mensual, etc.) para que podamos coordinar una operación programada.',
                'category' => 'Operaciones programadas',
            ],
        ];

        foreach ($faqs as $i => $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['order' => $i, 'is_published' => true])
            );
        }
    }
}
