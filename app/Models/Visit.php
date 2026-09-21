<?php

namespace App\Models;

use App\Helpers\DB;

class Visit
{
    /**
     * Obtiene métricas generales de tráfico y conversiones.
     */
    public static function getStats(): array
    {
        $todayVisits = (int)(DB::selectOne("SELECT COUNT(*) as count FROM visits WHERE DATE(visited_at) = CURDATE()")['count'] ?? 0);
        $todayUniqueIps = (int)(DB::selectOne("SELECT COUNT(DISTINCT ip_address) as count FROM visits WHERE DATE(visited_at) = CURDATE()")['count'] ?? 0);
        $todayForms = (int)(DB::selectOne("SELECT COUNT(DISTINCT session_id) as count FROM visits WHERE has_submitted_form = 1 AND DATE(visited_at) = CURDATE()")['count'] ?? 0);

        $totalVisits = (int)(DB::selectOne("SELECT COUNT(*) as count FROM visits")['count'] ?? 0);
        $totalSessions = (int)(DB::selectOne("SELECT COUNT(DISTINCT session_id) as count FROM visits")['count'] ?? 0);
        $totalForms = (int)(DB::selectOne("SELECT COUNT(DISTINCT session_id) as count FROM visits WHERE has_submitted_form = 1")['count'] ?? 0);

        $conversionRate = $totalSessions > 0 ? round(($totalForms / $totalSessions) * 100, 1) : 0;
        $todayConversionRate = $todayUniqueIps > 0 ? round(($todayForms / $todayUniqueIps) * 100, 1) : 0;

        return [
            'today_visits' => $todayVisits,
            'today_unique_ips' => $todayUniqueIps,
            'today_forms' => $todayForms,
            'today_conversion_rate' => $todayConversionRate,
            'total_visits' => $totalVisits,
            'total_sessions' => $totalSessions,
            'total_forms' => $totalForms,
            'conversion_rate' => $conversionRate,
        ];
    }

    /**
     * Obtiene las visitas más recientes.
     */
    public static function getRecent(int $limit = 10): array
    {
        return DB::select(
            "SELECT * FROM visits ORDER BY visited_at DESC, id DESC LIMIT :limit",
            ['limit' => $limit]
        );
    }

    /**
     * Listado paginado de visitas con filtros.
     */
    public static function paginate(int $page = 1, int $perPage = 25, array $filters = []): array
    {
        $offset = ($page - 1) * $perPage;
        $where = ["1=1"];
        $params = [];

        // Filtro de búsqueda libre
        if (!empty($filters['search'])) {
            $search = '%' . trim($filters['search']) . '%';
            $where[] = "(ip_address LIKE :s_ip OR page_title LIKE :s_title OR page_url LIKE :s_url OR referrer LIKE :s_ref OR utm_source LIKE :s_utm)";
            $params['s_ip'] = $search;
            $params['s_title'] = $search;
            $params['s_url'] = $search;
            $params['s_ref'] = $search;
            $params['s_utm'] = $search;
        }

        // Filtro de formulario
        if (isset($filters['form']) && $filters['form'] !== 'all' && $filters['form'] !== '') {
            if ($filters['form'] === 'yes') {
                $where[] = "has_submitted_form = 1";
            } elseif ($filters['form'] === 'no') {
                $where[] = "has_submitted_form = 0";
            }
        }

        // Filtro de fecha
        if (!empty($filters['date'])) {
            if ($filters['date'] === 'today') {
                $where[] = "DATE(visited_at) = CURDATE()";
            } elseif ($filters['date'] === 'yesterday') {
                $where[] = "DATE(visited_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
            } elseif ($filters['date'] === '7days') {
                $where[] = "visited_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
            } elseif ($filters['date'] === '30days') {
                $where[] = "visited_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
            }
        }

        $whereSql = implode(' AND ', $where);

        $countSql = "SELECT COUNT(*) as count FROM visits WHERE $whereSql";
        $total = (int)(DB::selectOne($countSql, $params)['count'] ?? 0);

        $dataSql = "SELECT * FROM visits WHERE $whereSql ORDER BY visited_at DESC, id DESC LIMIT $perPage OFFSET $offset";
        $items = DB::select($dataSql, $params);

        $lastPage = max(1, (int)ceil($total / $perPage));

        return [
            'data' => $items,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => $lastPage,
        ];
    }

    /**
     * Obtiene todo el recorrido de una sesión en particular.
     */
    public static function findBySession(string $sessionId): array
    {
        return DB::select(
            "SELECT * FROM visits WHERE session_id = :session_id ORDER BY visited_at ASC, id ASC",
            ['session_id' => $sessionId]
        );
    }

    /**
     * Top de páginas más visitadas.
     */
    public static function getTopPages(int $limit = 5): array
    {
        return DB::select(
            "SELECT page_title, page_url, COUNT(*) as total_views, SUM(has_submitted_form) as total_conversions 
             FROM visits 
             GROUP BY page_title, page_url 
             ORDER BY total_views DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }

    /**
     * Top fuentes de tráfico.
     */
    public static function getTopReferrers(int $limit = 5): array
    {
        return DB::select(
            "SELECT referrer, COUNT(*) as total 
             FROM visits 
             GROUP BY referrer 
             ORDER BY total DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
}
