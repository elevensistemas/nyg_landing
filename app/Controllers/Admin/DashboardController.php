<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Models\Visit;

class DashboardController extends AdminController
{
    public function index()
    {
        $stats = [
            'quotes_new' => (int)DB::selectOne("SELECT COUNT(*) as count FROM quote_requests WHERE status = 'nueva'")['count'],
            'quotes_total' => (int)DB::selectOne("SELECT COUNT(*) as count FROM quote_requests")['count'],
            'contacts_new' => (int)DB::selectOne("SELECT COUNT(*) as count FROM contact_requests WHERE status = 'nueva' OR status = 'nuevo'")['count'],
            'services_published' => (int)DB::selectOne("SELECT COUNT(*) as count FROM services WHERE is_published = 1 AND deleted_at IS NULL")['count'],
        ];

        $visitStats = Visit::getStats();
        $recentVisits = Visit::getRecent(8);

        $latestQuotes = DB::select("SELECT qr.*, s.name as service_name FROM quote_requests qr LEFT JOIN services s ON qr.service_id = s.id ORDER BY qr.created_at DESC LIMIT 5");
        $latestContacts = DB::select("SELECT * FROM contact_requests ORDER BY created_at DESC LIMIT 5");

        $this->renderAdmin('admin/dashboard', compact('stats', 'visitStats', 'recentVisits', 'latestQuotes', 'latestContacts'), 'Panel de Control');
    }
}
