<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Database;

try {
    $db = Database::getConnection();

    // 1. Create Tables
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $db->exec($sql);
    echo "Tablas creadas correctamente.\n";

    // 2. Insert Admin User
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute(['admin@nyg.com']);
    if ($stmt->fetchColumn() == 0) {
        $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
            ->execute(['Administrador', 'admin@nyg.com', password_hash('NyG26202620', PASSWORD_BCRYPT)]);
        echo "Usuario administrador creado: admin@nyg.com / NyG26202620\n";
    }

    // 3. Insert Default Settings
    $defaultSettings = [
        'brand_name' => 'NYG Transporte',
        'contact_phone' => '+5491100000000',
        'contact_phone_display' => '+54 (11) 0000-0000',
        'contact_email' => 'contacto@nygtransporte.com.ar',
        'contact_whatsapp' => '5491100000000',
        'address' => 'Buenos Aires, Argentina',
        'social_linkedin' => 'https://linkedin.com',
        'social_instagram' => 'https://instagram.com',
    ];

    foreach ($defaultSettings as $key => $val) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM settings WHERE key = ?");
        $stmt->execute([$key]);
        if ($stmt->fetchColumn() == 0) {
            $db->prepare("INSERT INTO settings (key, value) VALUES (?, ?)")->execute([$key, $val]);
        }
    }

    // 4. Insert Default Legal Pages
    $legalPages = [
        ['title' => 'Términos y Condiciones', 'slug' => 'terminos-y-condiciones', 'content' => '<p>Términos y condiciones de servicio de NYG Transporte.</p>'],
        ['title' => 'Política de Privacidad', 'slug' => 'politica-de-privacidad', 'content' => '<p>Política de privacidad de NYG Transporte.</p>'],
    ];

    foreach ($legalPages as $page) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM legal_pages WHERE slug = ?");
        $stmt->execute([$page['slug']]);
        if ($stmt->fetchColumn() == 0) {
            $db->prepare("INSERT INTO legal_pages (title, slug, content) VALUES (?, ?, ?)")
                ->execute([$page['title'], $page['slug'], $page['content']]);
        }
    }

    // 5. Run seeders
    require __DIR__ . '/run_seeders.php';

    echo "Base de datos inicializada exitosamente.\n";
} catch (Exception $e) {
    echo "Error inicializando la base de datos: " . $e->getMessage() . "\n";
}
