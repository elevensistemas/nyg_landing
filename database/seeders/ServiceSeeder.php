<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Las descripciones parten únicamente de lo publicado en el sitio actual
     * de NYG (transporte con seguimiento satelital, carga congelada y
     * supercongelada, gestión aduanera, almacenamiento, distribución, puerta
     * a puerta, gestión de compras, cargas completas). No se agregan
     * capacidades no confirmadas.
     */
    public function run(): void
    {
        $transporte = ServiceCategory::where('slug', 'transporte')->first();
        $almacen = ServiceCategory::where('slug', 'almacenamiento-y-distribucion')->first();
        $comex = ServiceCategory::where('slug', 'comercio-exterior')->first();

        $services = [
            [
                'category' => $transporte,
                'name' => 'Transporte terrestre',
                'problem' => 'Necesitás que tus insumos o productos lleguen a planta o al centro de distribución sin demoras ni sorpresas.',
                'short_description' => 'Transportamos insumos y productos para el abastecimiento de plantas productivas y centros de distribución.',
                'description' => "Coordinamos el transporte terrestre de tu carga con unidades preparadas según el tipo de mercadería y el destino. Cada unidad de la flota cuenta con seguimiento satelital con recupero, visible para el cliente en tiempo real.\n\nTrabajamos la operación de punta a punta: retiro, traslado y confirmación de entrega, manteniendo informado al cliente sobre el estado de su envío.",
                'benefits' => "Seguimiento satelital de la unidad.\nCoordinación de horarios de retiro y entrega.\nInformación del estado del envío durante todo el trayecto.",
                'icon' => 'truck',
                'is_featured_on_home' => true,
            ],
            [
                'category' => $transporte,
                'name' => 'Cross-Docking',
                'problem' => 'Necesitás agilizar la distribución y transferir mercadería con mínimo almacenamiento.',
                'short_description' => 'Transferencia directa de mercadería con mínimo almacenamiento para acelerar los tiempos de tránsito.',
                'description' => "Consolidamos y desconsolidamos cargas directamente en nuestras plataformas de transferencia. Los productos entrantes se despachan de forma inmediata hacia sus destinos finales, reduciendo costos de almacenamiento y optimizando los tiempos de tránsito.",
                'benefits' => "Reducción en los costos de almacenamiento y manipulación.\nDisminución del tiempo total del ciclo de entrega.\nOptimización del flujo de stock en centros urbanos.",
                'icon' => 'refresh-cw',
                'is_featured_on_home' => true,
            ],
            [
                'category' => $almacen,
                'name' => 'Almacenamiento',
                'problem' => 'Necesitás un lugar confiable para recibir, clasificar y preparar tu mercadería antes del despacho.',
                'short_description' => 'Recepción, clasificación y almacenamiento de productos, con preparación y despacho de envíos.',
                'description' => "Recepcionamos, clasificamos y almacenamos los productos de cada cliente en nuestros depósitos, para luego realizar la preparación y el despacho de los envíos según la demanda.",
                'benefits' => "Recepción y clasificación ordenada de mercadería.\nPreparación de pedidos antes del despacho.\nCoordinación directa con el área de distribución.",
                'icon' => 'warehouse',
                'is_featured_on_home' => true,
            ],
            [
                'category' => $almacen,
                'name' => 'Distribución',
                'problem' => 'Tenés que llegar a muchos puntos de entrega distintos, con tiempos y costos que tengan sentido.',
                'short_description' => 'Red de distribución versátil y flexible, con servicios de calidad a precios competitivos.',
                'description' => "Contamos con una red de distribución versátil y flexible que permite brindar un servicio de calidad a precios competitivos, adaptándonos a los puntos de entrega y tiempos que necesita cada operación.",
                'benefits' => "Red de distribución flexible.\nAdaptación a múltiples puntos de entrega.\nCoordinación con almacenamiento y transporte.",
                'icon' => 'route',
                'is_featured_on_home' => true,
            ],
            [
                'category' => $transporte,
                'name' => 'Cargas completas',
                'problem' => 'Necesitás mover un volumen grande de mercadería en un solo viaje, sin compartir unidad con otra carga.',
                'short_description' => 'Transporte de cargas completas, coordinado según el volumen y el tipo de mercadería.',
                'description' => "Coordinamos el traslado de cargas completas de una forma personalizada, evaluando el tipo de mercadería, el destino y los tiempos requeridos para cada operación.",
                'benefits' => "Traslado dedicado por operación.\nCoordinación personalizada de horarios.\nSeguimiento satelital de la unidad.",
                'icon' => 'container',
                'is_featured_on_home' => false,
            ],
            [
                'category' => $almacen,
                'name' => 'Servicios puerta a puerta',
                'problem' => 'Necesitás que el envío llegue directamente a destino, sin intermediarios ni pasos adicionales.',
                'short_description' => 'Servicio integral de envíos puerta a puerta.',
                'description' => "Brindamos un servicio de envío puerta a puerta, ocupándonos del traslado completo de la mercadería desde el punto de origen hasta el destino final indicado por el cliente.",
                'benefits' => "Traslado directo a destino.\nMenos pasos y coordinación simplificada.\nInformación del estado del envío.",
                'icon' => 'door-open',
                'is_featured_on_home' => false,
            ],
            [
                'category' => $almacen,
                'name' => 'Gestión de compras y retiros',
                'problem' => 'Necesitás que alguien se encargue de retirar la mercadería comprada y coordinar su traslado.',
                'short_description' => 'Gestión de compra y retiro de mercadería para su posterior traslado.',
                'description' => "Nos encargamos de la gestión de compra y el retiro de la mercadería en el punto de origen, coordinando el traslado posterior según las necesidades del cliente.",
                'benefits' => "Gestión y retiro coordinado.\nMenos gestiones a cargo del cliente.\nSeguimiento del proceso completo.",
                'icon' => 'clipboard-check',
                'is_featured_on_home' => false,
            ],
            [
                'category' => $comex,
                'name' => 'Transporte y gestión aduanera',
                'problem' => 'Tu operación de importación o exportación necesita transporte y gestión aduanera coordinados.',
                'short_description' => 'Transporte y gestión aduanera para operaciones de importación y exportación.',
                'description' => "Ofrecemos servicio de transporte y gestión aduanera, tanto para operaciones de importación como de exportación, dentro del alcance confirmado de nuestra operación actual.",
                'benefits' => "Transporte asociado a operaciones de comercio exterior.\nGestión aduanera de importación y exportación.\nCoordinación con el resto de la cadena logística.",
                'icon' => 'ship',
                'is_featured_on_home' => false,
            ],
        ];

        foreach ($services as $i => $data) {
            $category = $data['category'];
            unset($data['category']);
            $data['slug'] = Str::slug($data['name']);
            $data['order'] = $i;
            $data['is_published'] = true;
            $data['service_category_id'] = $category?->id;

            Service::query()->updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
