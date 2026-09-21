<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\ContactRequest;

class ContactRequestController extends AdminController
{
    public function index()
    {
        $status = $_GET['status'] ?? '';
        $sql = "SELECT * FROM contact_requests";
        $params = [];
        if (!empty($status)) {
            $sql .= " WHERE status = :status";
            $params['status'] = $status;
        }
        $sql .= " ORDER BY created_at DESC";
        $contacts = DB::select($sql, $params);

        $this->renderAdmin('admin/contact-requests/index', compact('contacts'), 'Consultas de contacto');
    }

    public function show(int $id)
    {
        $contact = ContactRequest::find($id);
        if (!$contact) {
            \Flight::notFound();
            return;
        }

        if (empty($contact['read_at'])) {
            ContactRequest::update($id, [
                'read_at' => date('Y-m-d H:i:s'),
                'status' => 'leido'
            ]);
            $contact = ContactRequest::find($id); // Reload
        }

        $this->renderAdmin('admin/contact-requests/show', compact('contact'), 'Ver consulta');
    }

    public function update(int $id)
    {
        $status = \Flight::request()->data->status;
        $allowed = ['nuevo', 'leido', 'respondido', 'descartado', 'nueva']; // including 'nueva' for compatibility

        if (in_array($status, $allowed)) {
            ContactRequest::update($id, ['status' => $status]);
            $_SESSION['success'] = 'Consulta actualizada.';
        } else {
            $_SESSION['error'] = 'Estado no válido.';
        }

        \Flight::redirect(route('admin.contact-requests.index'));
    }

    public function destroy(int $id)
    {
        ContactRequest::delete($id);
        $_SESSION['success'] = 'Consulta eliminada.';
        \Flight::redirect(route('admin.contact-requests.index'));
    }
}
