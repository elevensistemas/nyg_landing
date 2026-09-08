<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use App\Models\Setting;
use Core\View;

Setting::set('under_construction', '1');
$html = View::render('under_construction', [], null);

echo "HTML generated successfully!\n";
echo "Length: " . strlen($html) . " bytes\n";
echo "Title check: " . (str_contains($html, 'Página en Construcción') ? "OK" : "FAIL") . "\n";
echo "Logo check: " . (str_contains($html, 'IMG_6178.PNG') ? "OK" : "FAIL") . "\n";
