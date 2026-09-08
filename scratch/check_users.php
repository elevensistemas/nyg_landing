<?php
require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use Core\Database;

$users = Database::fetchAll("SELECT id, name, email FROM users");
print_r($users);
