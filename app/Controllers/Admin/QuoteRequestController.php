<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\QuoteRequest;

class QuoteRequestController {
    public function index(Request $request): string {
        return View::render('admin.quote-requests.index', [
            'quoteRequests' => QuoteRequest::all(),
            'metaTitle' => 'Solicitudes de Cotización — CMS NYG'
        ], 'layouts/admin');
    }

    public function show(Request $request, int $id): string {
        $quoteRequest = QuoteRequest::find($id);
        if (!$quoteRequest) {
            Response::notFound('Solicitud no encontrada.');
        }

        return View::render('admin.quote-requests.show', [
            'quoteRequest' => $quoteRequest,
            'metaTitle' => 'Detalle de Cotización #' . $id . ' — CMS NYG'
        ], 'layouts/admin');
    }

    public function update(Request $request, int $id): void {
        $status = $request->input('status', 'pending');
        $notes = $request->input('notes', '');
        QuoteRequest::updateStatus($id, $status, $notes);

        flash('success', 'Estado de cotización actualizado.');
        Response::redirect('/admin/quote-requests/' . $id);
    }

    public function destroy(Request $request, int $id): void {
        QuoteRequest::delete($id);
        flash('success', 'Solicitud de cotización eliminada.');
        Response::redirect('/admin/quote-requests');
    }
}
