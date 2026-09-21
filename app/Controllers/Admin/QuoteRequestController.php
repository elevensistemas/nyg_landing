<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\QuoteRequest;

class QuoteRequestController extends AdminController
{
    public function index()
    {
        $status = $_GET['status'] ?? '';
        $q = $_GET['q'] ?? '';

        $sql = "SELECT qr.*, s.name as service_name FROM quote_requests qr LEFT JOIN services s ON qr.service_id = s.id";
        $where = [];
        $params = [];

        if (!empty($status)) {
            $where[] = "qr.status = :status";
            $params['status'] = $status;
        }

        if (!empty($q)) {
            $where[] = "(qr.full_name LIKE :q OR qr.company LIKE :q OR qr.email LIKE :q)";
            $params['q'] = '%' . $q . '%';
        }

        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY qr.created_at DESC";
        $quotes = DB::select($sql, $params);

        $statuses = QuoteRequest::STATUSES;
        $this->renderAdmin('admin/quote-requests/index', compact('quotes', 'statuses'), 'Cotizaciones');
    }

    public function show(int $id)
    {
        $quote = QuoteRequest::find($id);
        if (!$quote) {
            \Flight::notFound();
            return;
        }

        if (empty($quote['read_at'])) {
            QuoteRequest::update($id, ['read_at' => date('Y-m-d H:i:s')]);
            $quote = QuoteRequest::find($id); // Reload
        }

        $attachments = QuoteRequest::getAttachments($id);
        $statuses = QuoteRequest::STATUSES;

        $this->renderAdmin('admin/quote-requests/show', compact('quote', 'attachments', 'statuses'), 'Ver cotización');
    }

    public function update(int $id)
    {
        $status = \Flight::request()->data->status;
        $internal_notes = \Flight::request()->data->internal_notes;

        $statuses = QuoteRequest::STATUSES;
        if (array_key_type($status, $statuses) !== null) {
            QuoteRequest::update($id, [
                'status' => $status,
                'internal_notes' => !empty($internal_notes) ? trim($internal_notes) : null
            ]);
            $_SESSION['success'] = 'Solicitud de cotización actualizada.';
        } else {
            $_SESSION['error'] = 'Estado no válido.';
        }

        \Flight::redirect(route('admin.quote-requests.index'));
    }

    public function destroy(int $id)
    {
        $attachments = QuoteRequest::getAttachments($id);
        foreach ($attachments as $attachment) {
            $filePath = __DIR__ . '/../../public/storage/' . $attachment['path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete parent folder if empty
        $folderPath = __DIR__ . '/../../public/storage/quotes/' . $id;
        if (is_dir($folderPath)) {
            @rmdir($folderPath);
        }

        QuoteRequest::delete($id);
        $_SESSION['success'] = 'Solicitud eliminada.';
        \Flight::redirect(route('admin.quote-requests.index'));
    }
}

// Inline key checker helper
function array_key_type($key, $array) {
    return isset($array[$key]) ? $key : null;
}
