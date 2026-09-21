<?php

namespace App\Controllers\Admin;

use App\Models\Visit;

class VisitController extends AdminController
{
    public function index()
    {
        $page = max(1, (int)($_GET['page'] ?? 1));
        $filters = [
            'search' => trim($_GET['search'] ?? ''),
            'form' => trim($_GET['form'] ?? 'all'),
            'date' => trim($_GET['date'] ?? 'all'),
        ];

        $visits = Visit::paginate($page, 30, $filters);
        $stats = Visit::getStats();
        $topPages = Visit::getTopPages(5);
        $topReferrers = Visit::getTopReferrers(5);

        $this->renderAdmin(
            'admin/visits/index',
            compact('visits', 'stats', 'filters', 'topPages', 'topReferrers'),
            'Medidor de Visitas y Conversión'
        );
    }

    public function show(string $sessionId)
    {
        $sessionVisits = Visit::findBySession($sessionId);

        if (empty($sessionVisits)) {
            $_SESSION['error'] = 'No se encontró el registro de esa visita.';
            \Flight::redirect(route('admin.visits.index'));
            return;
        }

        $visitorIp = $sessionVisits[0]['ip_address'] ?? 'Desconocida';
        $visitorDevice = $sessionVisits[0]['device_type'] ?? 'Escritorio';
        $visitorBrowser = $sessionVisits[0]['browser'] ?? 'Desconocido';
        $visitorReferrer = $sessionVisits[0]['referrer'] ?? 'Directo';

        $this->renderAdmin(
            'admin/visits/show',
            compact('sessionVisits', 'sessionId', 'visitorIp', 'visitorDevice', 'visitorBrowser', 'visitorReferrer'),
            'Detalle de Navegación del Visitante'
        );
    }
}
