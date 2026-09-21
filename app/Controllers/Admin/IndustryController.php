<?php

namespace App\Controllers\Admin;

use App\Models\Industry;

class IndustryController extends AdminController
{
    public function index()
    {
        $industries = Industry::all();

        $this->renderAdmin('admin/industries/index', compact('industries'), 'Sectores Atendidos');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $name = trim($data->name ?? '');
        $description = trim($data->description ?? '');
        $icon = trim($data->icon ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($name)) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            \Flight::redirect(route('admin.industries.index'));
            return;
        }

        Industry::create([
            'name' => $name,
            'slug' => slugify($name),
            'description' => !empty($description) ? $description : null,
            'icon' => !empty($icon) ? $icon : null,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Sector creado. Recordá que solo debe publicarse si está confirmado por NYG.';
        \Flight::redirect(route('admin.industries.index'));
    }

    public function update(int $id)
    {
        $data = \Flight::request()->data;
        $name = trim($data->name ?? '');
        $description = trim($data->description ?? '');
        $icon = trim($data->icon ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($name)) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            \Flight::redirect(route('admin.industries.index'));
            return;
        }

        Industry::update($id, [
            'name' => $name,
            'description' => !empty($description) ? $description : null,
            'icon' => !empty($icon) ? $icon : null,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Sector actualizado.';
        \Flight::redirect(route('admin.industries.index'));
    }

    public function destroy(int $id)
    {
        Industry::delete($id);
        $_SESSION['success'] = 'Sector eliminado.';
        \Flight::redirect(route('admin.industries.index'));
    }
}
