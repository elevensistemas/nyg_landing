<?php

namespace App\Middleware;

use App\Helpers\Tracker;

class VisitTrackerMiddleware
{
    public static function check(): void
    {
        // Solo registrar peticiones GET
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'GET') {
            Tracker::recordVisit();
        }
    }
}
