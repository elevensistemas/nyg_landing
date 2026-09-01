<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\Client;

class ClientController {
    public function index(Request $request): string {
        return View::render('admin.clients.index', [
            'clients' => Client::all(),
            'metaTitle' => 'Gestión de Clientes — CMS NYG'
        ], 'layouts/admin');
    }

    public function store(Request $request): void {
        $name = trim((string)$request->input('name'));
        if (!empty($name)) {
            Client::create([
                'name' => $name,
                'industry' => $request->input('industry', ''),
                'testimonial' => $request->input('testimonial', ''),
                'author_name' => $request->input('author_name', ''),
                'author_role' => $request->input('author_role', ''),
                'is_featured' => $request->input('is_featured', 0) ? 1 : 0,
                'is_active' => $request->input('is_active', 1) ? 1 : 0,
                'sort_order' => (int)$request->input('sort_order', 0)
            ]);
            flash('success', 'Cliente agregado exitosamente.');
        } else {
            flash('error', 'El nombre del cliente es obligatorio.');
        }

        Response::redirect('/admin/clients');
    }

    public function destroy(Request $request, int $id): void {
        Client::delete($id);
        flash('success', 'Cliente eliminado.');
        Response::redirect('/admin/clients');
    }
}
