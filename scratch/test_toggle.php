<?php

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/Helpers.php';

use App\Models\Setting;
use Core\Application;
use Core\Request;

// 1. Reset setting to 0
Setting::set('under_construction', '0');
echo "Initial setting 'under_construction': " . Setting::get('under_construction') . "\n";

// 2. Test updating via SettingController logic
$data = ['under_construction' => '1', 'under_construction_title' => 'Sitio en Mantenimiento Provisorio'];
$data['under_construction'] = isset($data['under_construction']) && ($data['under_construction'] === '1' || $data['under_construction'] === 'on') ? '1' : '0';
Setting::updateMany($data);

echo "Updated setting 'under_construction': " . Setting::get('under_construction') . "\n";
echo "Updated title: " . Setting::get('under_construction_title') . "\n";

// 3. Set back to '0' so default site is active, ready for admin toggle
Setting::set('under_construction', '0');
echo "Reset setting to 0 for site display: " . Setting::get('under_construction') . "\n";
