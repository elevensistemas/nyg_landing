<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\Setting;

class SettingController {
    public function edit(Request $request): string {
        return View::render('admin.settings.edit', [
            'settings' => Setting::all(),
            'metaTitle' => 'Configuración General — CMS NYG'
        ], 'layouts/admin');
    }

    public function update(Request $request): void {
        $data = $request->all();
        unset($data['_csrf_token'], $data['_method']);

        // Checkbox handle: if not present in request payload, set to '0'
        $data['under_construction'] = isset($data['under_construction']) && ($data['under_construction'] === '1' || $data['under_construction'] === 'on') ? '1' : '0';

        Setting::updateMany($data);

        flash('success', 'Configuración del sitio actualizada correctamente.');
        Response::redirect('/admin/settings');
    }
}
