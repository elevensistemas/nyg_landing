<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Application;
use Core\Auth;

$app = new Application();
$routes = require __DIR__ . '/../config/routes.php';
$routes($app->router);

$testRoutes = [
    '/' => 'Logística bajo control',
    '/empresa' => 'Sobre Nosotros',
    '/servicios' => 'Soluciones logísticas',
    '/tecnologia-y-seguimiento' => 'Tecnología',
    '/clientes' => 'Empresas que confiaron',
    '/preguntas-frecuentes' => 'Preguntas frecuentes',
    '/contacto' => 'Contacto',
    '/cotizacion' => 'Solicitá tu cotización',
    '/admin/login' => 'NYG Admin',
];

foreach ($testRoutes as $path => $expectedText) {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['REQUEST_URI'] = $path;

    ob_start();
    try {
        $app->run();
        $output = ob_get_clean();
        if (str_contains($output, $expectedText)) {
            echo "[OK] Route '{$path}' rendered successfully.\n";
        } else {
            echo "[FAIL] Route '{$path}' rendered but text '{$expectedText}' was not found.\n";
        }
    } catch (\Throwable $e) {
        ob_end_clean();
        echo "[ERROR] Route '{$path}' thrown exception: " . $e->getMessage() . "\n";
    }
}
