<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Database;

try {
    $db = Database::getConnection();

    echo "Iniciando sembrado de datos (Seeders)...\n";

    // 1. Service Categories
    $categories = [
        ['name' => 'Transporte y Carga', 'slug' => 'transporte', 'description' => 'Servicios de transporte terrestre de corta, media y larga distancia.'],
        ['name' => 'Almacenamiento y Distribución', 'slug' => 'almacenamiento-y-distribucion', 'description' => 'Gestión de depósitos, inventarios y logística capilar.'],
        ['name' => 'Comercio Exterior', 'slug' => 'comercio-exterior', 'description' => 'Operaciones aduaneras e internacionales.'],
    ];

    foreach ($categories as $cat) {
        $stmt = $db->prepare("SELECT id FROM service_categories WHERE slug = ?");
        $stmt->execute([$cat['slug']]);
        if (!$stmt->fetch()) {
            $db->prepare("INSERT INTO service_categories (name, slug, description) VALUES (?, ?, ?)")
               ->execute([$cat['name'], $cat['slug'], $cat['description']]);
        }
    }
    echo "[OK] Categorías de servicio creadas.\n";

    // Fetch Category IDs
    $catMap = [];
    $rows = Database::fetchAll("SELECT id, slug FROM service_categories");
    foreach ($rows as $row) {
        $catMap[$row['slug']] = $row['id'];
    }

    // 2. Services
    $services = [
        [
            'service_category_id' => $catMap['transporte'] ?? 1,
            'title' => 'Transporte terrestre',
            'slug' => 'transporte-terrestre',
            'summary' => 'Transportamos insumos y productos para el abastecimiento de plantas productivas y centros de distribución.',
            'description' => "Coordinamos el transporte terrestre de tu carga con unidades preparadas según el tipo de mercadería y el destino. Cada unidad de la flota cuenta con seguimiento satelital con recupero, visible para el cliente en tiempo real.\n\nTrabajamos la operación de punta a punta: retiro, traslado y confirmación de entrega.",
            'cover_image' => null,
            'is_featured' => 1,
            'sort_order' => 1
        ],
        [
            'service_category_id' => $catMap['transporte'] ?? 1,
            'title' => 'Cross-Docking',
            'slug' => 'cross-docking',
            'summary' => 'Transferencia directa de mercadería con mínimo almacenamiento para acelerar los tiempos de tránsito.',
            'description' => "Consolidamos y desconsolidamos cargas directamente en nuestras plataformas de transferencia. Los productos entrantes se despachan de forma inmediata hacia sus destinos finales, reduciendo costos de almacenamiento y optimizando los tiempos de tránsito.",
            'cover_image' => null,
            'is_featured' => 1,
            'sort_order' => 2
        ],
        [
            'service_category_id' => $catMap['almacenamiento-y-distribucion'] ?? 2,
            'title' => 'Almacenamiento',
            'slug' => 'almacenamiento',
            'summary' => 'Recepción, clasificación y almacenamiento de productos, con preparación y despacho de envíos.',
            'description' => "Recepcionamos, clasificamos y almacenamos los productos de cada cliente en nuestros depósitos, para luego realizar la preparación y el despacho de los envíos según la demanda.",
            'cover_image' => null,
            'is_featured' => 1,
            'sort_order' => 3
        ],
        [
            'service_category_id' => $catMap['almacenamiento-y-distribucion'] ?? 2,
            'title' => 'Distribución',
            'slug' => 'distribucion',
            'summary' => 'Red de distribución versátil y flexible, con servicios de calidad a precios competitivos.',
            'description' => "Contamos con una red de distribución versátil y flexible que permite brindar un servicio de calidad a precios competitivos, adaptándonos a los puntos de entrega y tiempos que necesita cada operación.",
            'cover_image' => null,
            'is_featured' => 1,
            'sort_order' => 4
        ],
        [
            'service_category_id' => $catMap['transporte'] ?? 1,
            'title' => 'Cargas completas',
            'slug' => 'cargas-completas',
            'summary' => 'Transporte de cargas completas, coordinado según el volumen y el tipo de mercadería.',
            'description' => "Coordinamos el traslado de cargas completas de una forma personalizada, evaluando el tipo de mercadería, el destino y los tiempos requeridos para cada operación.",
            'cover_image' => null,
            'is_featured' => 0,
            'sort_order' => 5
        ],
        [
            'service_category_id' => $catMap['almacenamiento-y-distribucion'] ?? 2,
            'title' => 'Servicios puerta a puerta',
            'slug' => 'servicios-puerta-a-puerta',
            'summary' => 'Servicio integral de envíos puerta a puerta.',
            'description' => "Brindamos un servicio de envío puerta a puerta, ocupándonos del traslado completo de la mercadería desde el punto de origen hasta el destino final indicado por el cliente.",
            'cover_image' => null,
            'is_featured' => 0,
            'sort_order' => 6
        ],
    ];

    foreach ($services as $srv) {
        $stmt = $db->prepare("SELECT id FROM services WHERE slug = ?");
        $stmt->execute([$srv['slug']]);
        if (!$stmt->fetch()) {
            $db->prepare("INSERT INTO services (service_category_id, title, slug, summary, description, is_featured, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)")
               ->execute([$srv['service_category_id'], $srv['title'], $srv['slug'], $srv['summary'], $srv['description'], $srv['is_featured'], $srv['sort_order']]);
        }
    }
    echo "[OK] Servicios sembrados.\n";

    // 3. Clients
    $clients = [
        ['name' => 'YPF', 'logo_url' => '/images/logo-ypf.png', 'is_featured' => 1, 'sort_order' => 1],
        ['name' => 'Quilmes', 'logo_url' => '/images/logo-quilmes.png', 'is_featured' => 1, 'sort_order' => 2],
        ['name' => 'Shell', 'logo_url' => '/images/logo-shell.png', 'is_featured' => 1, 'sort_order' => 3],
        ['name' => 'Danone', 'logo_url' => '/images/logo-danone.png', 'is_featured' => 1, 'sort_order' => 4],
    ];

    foreach ($clients as $cli) {
        $stmt = $db->prepare("SELECT id FROM clients WHERE name = ?");
        $stmt->execute([$cli['name']]);
        if (!$stmt->fetch()) {
            $db->prepare("INSERT INTO clients (name, logo_url, is_featured, sort_order) VALUES (?, ?, ?, ?)")
               ->execute([$cli['name'], $cli['logo_url'], $cli['is_featured'], $cli['sort_order']]);
        }
    }
    echo "[OK] Clientes sembrados.\n";

    // 4. FAQs
    $faqs = [
        [
            'question' => '¿Con qué tipo de cobertura geográfica cuentan?',
            'answer' => 'Brindamos cobertura en todo el territorio nacional argentino, coordinando rutas troncales de media y larga distancia, así como distribución capilar.',
            'sort_order' => 1
        ],
        [
            'question' => '¿Cómo funciona el seguimiento satelital de la mercadería?',
            'answer' => 'Todas nuestras unidades cuentan con monitoreo satelital GPS en tiempo real. Al iniciar el envío, proporcionamos acceso para verificar la ubicación de tu carga.',
            'sort_order' => 2
        ],
        [
            'question' => '¿Realizan transporte de cargas con temperatura controlada?',
            'answer' => 'Sí, disponemos de unidades reconfigurables para carga refrigerada, congelada y supercongelada con monitoreo continuo de temperatura.',
            'sort_order' => 3
        ],
    ];

    foreach ($faqs as $faq) {
        $stmt = $db->prepare("SELECT id FROM faqs WHERE question = ?");
        $stmt->execute([$faq['question']]);
        if (!$stmt->fetch()) {
            $db->prepare("INSERT INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)")
               ->execute([$faq['question'], $faq['answer'], $faq['sort_order']]);
        }
    }
    echo "[OK] Preguntas frecuentes sembradas.\n";

    echo "¡Sembrado de datos finalizado con éxito!\n";
} catch (Exception $e) {
    echo "Error ejecutando seeders: " . $e->getMessage() . "\n";
}
