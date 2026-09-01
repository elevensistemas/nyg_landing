<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\ContactRequest;

class ContactRequestController {
    public function index(Request $request): string {
        return View::render('admin.contact-requests.index', [
            'contactRequests' => ContactRequest::all(),
            'metaTitle' => 'Mensajes de Contacto — CMS NYG'
        ], 'layouts/admin');
    }

    public function show(Request $request, int $id): string {
        $contactRequest = ContactRequest::find($id);
        if (!$contactRequest) {
            Response::notFound('Mensaje no encontrado.');
        }

        return View::render('admin.contact-requests.show', [
            'contactRequest' => $contactRequest,
            'metaTitle' => 'Detalle de Mensaje #' . $id . ' — CMS NYG'
        ], 'layouts/admin');
    }

    public function update(Request $request, int $id): void {
        $status = $request->input('status', 'pending');
        $notes = $request->input('notes', '');
        ContactRequest::updateStatus($id, $status, $notes);

        flash('success', 'Estado del mensaje actualizado.');
        Response::redirect('/admin/contact-requests/' . $id);
    }

    public function destroy(Request $request, int $id): void {
        ContactRequest::delete($id);
        flash('success', 'Mensaje eliminado.');
        Response::redirect('/admin/contact-requests');
    }
}
