<?php

namespace App\Controllers\Admin;

use App\Models\ServiceCategory;

class ServiceCategoryController extends AdminController
{
    public function index()
    {
        $categories = ServiceCategory::all();

        $this->renderAdmin('admin/service-categories/index', compact('categories'), 'Categorías de Servicio');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $name = trim($data->name ?? '');
        $description = trim($data->description ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;

        if (empty($name)) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            \Flight::redirect(route('admin.service-categories.index'));
            return;
        }

        ServiceCategory::create([
            'name' => $name,
            'slug' => slugify($name),
            'description' => !empty($description) ? $description : null,
            'order' => $order,
            'is_published' => 1
        ]);

        $_SESSION['success'] = 'Categoría creada.';
        \Flight::redirect(route('admin.service-categories.index'));
    }

    public function update(int $id)
    {
        $data = \Flight::request()->data;
        $name = trim($data->name ?? '');
        $description = trim($data->description ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($name)) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            \Flight::redirect(route('admin.service-categories.index'));
            return;
        }

        ServiceCategory::update($id, [
            'name' => $name,
            'description' => !empty($description) ? $description : null,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Categoría actualizada.';
        \Flight::redirect(route('admin.service-categories.index'));
    }

    public function destroy(int $id)
    {
        ServiceCategory::delete($id);
        $_SESSION['success'] = 'Categoría eliminada.';
        \Flight::redirect(route('admin.service-categories.index'));
    }
}
