<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController {
    public function index(Request $request): string {
        return View::render('admin.services.index', [
            'services' => Service::all(),
            'metaTitle' => 'Gestión de Servicios — CMS NYG'
        ], 'layouts/admin');
    }

    public function create(Request $request): string {
        return View::render('admin.services.create', [
            'categories' => ServiceCategory::all(),
            'metaTitle' => 'Nuevo Servicio — CMS NYG'
        ], 'layouts/admin');
    }

    public function store(Request $request): void {
        $title = trim((string)$request->input('title'));
        if (empty($title)) {
            flash('error', 'El título del servicio es obligatorio.');
            Response::redirect('/admin/services/create');
        }

        Service::create([
            'title' => $title,
            'slug' => $request->input('slug'),
            'service_category_id' => $request->input('service_category_id'),
            'summary' => $request->input('summary', ''),
            'description' => $request->input('description', ''),
            'icon' => $request->input('icon', ''),
            'is_featured' => $request->input('is_featured', 0) ? 1 : 0,
            'is_active' => $request->input('is_active', 1) ? 1 : 0,
            'sort_order' => (int)$request->input('sort_order', 0)
        ]);

        flash('success', 'Servicio creado exitosamente.');
        Response::redirect('/admin/services');
    }

    public function edit(Request $request, int $id): string {
        $service = Service::find($id);
        if (!$service) {
            Response::notFound('Servicio no encontrado.');
        }

        return View::render('admin.services.edit', [
            'service' => $service,
            'categories' => ServiceCategory::all(),
            'metaTitle' => 'Editar Servicio — CMS NYG'
        ], 'layouts/admin');
    }

    public function update(Request $request, int $id): void {
        $title = trim((string)$request->input('title'));
        if (empty($title)) {
            flash('error', 'El título del servicio es obligatorio.');
            Response::redirect('/admin/services/' . $id . '/edit');
        }

        Service::update($id, [
            'title' => $title,
            'slug' => $request->input('slug'),
            'service_category_id' => $request->input('service_category_id'),
            'summary' => $request->input('summary', ''),
            'description' => $request->input('description', ''),
            'icon' => $request->input('icon', ''),
            'is_featured' => $request->input('is_featured', 0) ? 1 : 0,
            'is_active' => $request->input('is_active', 1) ? 1 : 0,
            'sort_order' => (int)$request->input('sort_order', 0)
        ]);

        flash('success', 'Servicio actualizado exitosamente.');
        Response::redirect('/admin/services');
    }

    public function destroy(Request $request, int $id): void {
        Service::delete($id);
        flash('success', 'Servicio eliminado exitosamente.');
        Response::redirect('/admin/services');
    }
}
