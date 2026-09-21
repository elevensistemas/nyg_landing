<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\Setting;

class SettingController extends AdminController
{
    public function edit()
    {
        $settingsRaw = DB::select("SELECT * FROM settings ORDER BY `group` ASC, `label` ASC");
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['group']][] = $s;
        }

        $this->renderAdmin('admin/settings/edit', compact('settings'), 'Configuración');
    }

    public function update()
    {
        $values = \Flight::request()->data->settings ?? [];

        foreach ($values as $key => $value) {
            Setting::update($key, $value);
        }

        $_SESSION['success'] = 'Configuración actualizada.';
        \Flight::redirect(route('admin.settings.edit'));
    }
}
