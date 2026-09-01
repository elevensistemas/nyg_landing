<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController {
    public function index(Request $request): string {
        $services = Service::allActive();
        $categories = ServiceCategory::allActive();

        return View::render('servicios.index', [
            'services' => $services,
            'categories' => $categories,
            'metaTitle' => 'Servicios de Logística y Transporte — NYG Transporte',
            'metaDescription' => 'Transporte terrestre, almacenamiento, distribución y gestión de logística adaptada a las necesidades de tu empresa.'
        ]);
    }

    public function show(Request $request, string $slug): string {
        $service = Service::findBySlug($slug);
        if (!$service) {
            Response::notFound('El servicio solicitado no existe.');
        }

        $allServices = Service::allActive();

        return View::render('servicios.show', [
            'service' => $service,
            'allServices' => $allServices,
            'metaTitle' => $service['title'] . ' — NYG Transporte',
            'metaDescription' => $service['summary'] ?? $service['title']
        ]);
    }
}
