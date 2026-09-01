<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Application;

$app = new Application();
$routes = require __DIR__ . '/../config/routes.php';
$routes($app->router);

echo "Rutas cargadas exitosamente.\n";

// Simular llamada a la página principal
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/';

ob_start();
$app->run();
$output = ob_get_clean();

if (str_contains($output, 'Logística bajo control')) {
    echo "Página de inicio renderizada CORRECTAMENTE con LightPHP! Total bytes: " . strlen($output) . "\n";
} else {
    echo "ADVERTENCIA: El renderizado no contiene la frase esperada.\n";
}
