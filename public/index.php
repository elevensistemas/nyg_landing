<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Application;

$app = new Application();

$routes = require __DIR__ . '/../config/routes.php';
$routes($app->router);

$app->run();
