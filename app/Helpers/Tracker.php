<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class Tracker
{
    /**
     * Registra una visita a una página pública.
     */
    public static function recordVisit(): void
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        // 1. Ignorar solicitudes a /admin, /sitemap.xml y archivos estáticos
        if (str_starts_with($path, '/admin') || $path === '/sitemap.xml') {
            return;
        }

        $staticExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp', 'css', 'js', 'map', 'mp4', 'woff', 'woff2', 'ttf', 'eot', 'txt'];
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (in_array($ext, $staticExtensions, true)) {
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionId = session_id();
        $ip = self::getClientIp();
        $userAgent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido', 0, 300);

        // 2. Throttle para evitar duplicados en recargas ultrarrápidas (< 3 segundos misma página)
        $nowTs = time();
        $lastPage = $_SESSION['_last_tracked_page'] ?? null;
        $lastTime = $_SESSION['_last_tracked_time'] ?? 0;
        if ($lastPage === $path && ($nowTs - $lastTime) < 3) {
            return;
        }

        $_SESSION['_last_tracked_page'] = $path;
        $_SESSION['_last_tracked_time'] = $nowTs;

        // 3. Obtener Título y datos amigables de la página
        $pageTitle = self::getPageTitle($path);

        // 4. UTM y Referrer
        $rawReferrer = $_SERVER['HTTP_REFERER'] ?? null;
        $utmSource = $_GET['utm_source'] ?? ($_SESSION['_utm_source'] ?? null);
        $utmMedium = $_GET['utm_medium'] ?? ($_SESSION['_utm_medium'] ?? null);
        $utmCampaign = $_GET['utm_campaign'] ?? ($_SESSION['_utm_campaign'] ?? null);

        if (!empty($_GET['utm_source'])) {
            $_SESSION['_utm_source'] = substr(trim($_GET['utm_source']), 0, 100);
        }
        if (!empty($_GET['utm_medium'])) {
            $_SESSION['_utm_medium'] = substr(trim($_GET['utm_medium']), 0, 100);
        }
        if (!empty($_GET['utm_campaign'])) {
            $_SESSION['_utm_campaign'] = substr(trim($_GET['utm_campaign']), 0, 100);
        }

        $formattedReferrer = self::classifyReferrer($rawReferrer, $utmSource);

        // 5. Dispositivo y Navegador
        $deviceType = self::getDeviceType($userAgent);
        $browser = self::getBrowser($userAgent);

        // 6. Fecha y Hora en zona horaria oficial de Argentina
        $dt = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
        $visitedAt = $dt->format('Y-m-d H:i:s');

        $hasSubmitted = !empty($_SESSION['_has_submitted_form']) ? 1 : 0;
        $formType = $_SESSION['_submitted_form_type'] ?? null;
        $formReqId = $_SESSION['_submitted_form_request_id'] ?? null;

        try {
            $visitId = DB::insert('visits', [
                'session_id' => $sessionId,
                'ip_address' => $ip,
                'page_url' => substr($uri, 0, 255),
                'page_title' => $pageTitle,
                'referrer' => substr($formattedReferrer, 0, 500),
                'utm_source' => $utmSource ? substr($utmSource, 0, 100) : null,
                'utm_medium' => $utmMedium ? substr($utmMedium, 0, 100) : null,
                'utm_campaign' => $utmCampaign ? substr($utmCampaign, 0, 100) : null,
                'device_type' => $deviceType,
                'browser' => $browser,
                'has_submitted_form' => $hasSubmitted,
                'form_type' => $formType,
                'form_request_id' => $formReqId,
                'visited_at' => $visitedAt,
            ]);

            $_SESSION['_last_visit_id'] = $visitId;
        } catch (\Throwable $e) {
            // Silencioso para no interrumpir la navegación pública en caso de error de BD
            error_log("Error guardando visita: " . $e->getMessage());
        }
    }

    /**
     * Marca la sesión actual y sus visitas como "Formulario completado".
     */
    public static function markFormSubmitted(string $formType, int $requestId): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['_has_submitted_form'] = true;
        $_SESSION['_submitted_form_type'] = $formType;
        $_SESSION['_submitted_form_request_id'] = $requestId;

        $sessionId = session_id();

        try {
            DB::query(
                "UPDATE visits SET has_submitted_form = 1, form_type = :form_type, form_request_id = :form_request_id WHERE session_id = :session_id",
                [
                    'form_type' => $formType,
                    'form_request_id' => $requestId,
                    'session_id' => $sessionId,
                ]
            );
        } catch (\Throwable $e) {
            error_log("Error actualizando estado de formulario en visita: " . $e->getMessage());
        }
    }

    /**
     * Obtiene la IP real del cliente considerando Cloudflare y proxies.
     */
    public static function getClientIp(): string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ips = explode(',', $_SERVER[$header]);
                $ip = trim($ips[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    /**
     * Devuelve el título representativo de la página visitada.
     */
    public static function getPageTitle(string $path): string
    {
        $clean = rtrim($path, '/');
        if ($clean === '' || $clean === '/') return 'Inicio';

        $map = [
            '/empresa' => 'Nosotros (Empresa)',
            '/servicios' => 'Listado de Servicios',
            '/servicios/transporte-terrestre' => 'Servicio: Transporte terrestre',
            '/servicios/cross-docking' => 'Servicio: Cross-Docking',
            '/servicios/almacenamiento' => 'Servicio: Almacenamiento',
            '/servicios/distribucion' => 'Servicio: Distribución',
            '/servicios/cargas-completas' => 'Servicio: Cargas completas',
            '/servicios/servicios-puerta-a-puerta' => 'Servicio: Puerta a puerta',
            '/servicios/gestion-de-compras-y-retiros' => 'Servicio: Compras y retiros',
            '/servicios/transporte-y-gestion-aduanera' => 'Servicio: Gestión aduanera',
            '/tecnologia-y-seguimiento' => 'Tecnología y Seguimiento',
            '/clientes' => 'Clientes',
            '/preguntas-frecuentes' => 'Preguntas Frecuentes (FAQ)',
            '/contacto' => 'Formulario de Contacto',
            '/cotizacion' => 'Formulario de Cotización',
            '/cotizacion/gracias' => 'Cotización enviada (Gracias)',
        ];

        if (isset($map[$clean])) {
            return $map[$clean];
        }

        if (str_starts_with($clean, '/legales/')) {
            $slug = str_replace('/legales/', '', $clean);
            return 'Página Legal (' . ucfirst($slug) . ')';
        }

        if (str_starts_with($clean, '/servicios/')) {
            $slug = str_replace('/servicios/', '', $clean);
            return 'Servicio: ' . ucwords(str_replace('-', ' ', $slug));
        }

        return $clean;
    }

    /**
     * Clasifica el origen de la visita (Meta Ads, Google, Directo, etc.)
     */
    public static function classifyReferrer(?string $rawReferrer, ?string $utmSource): string
    {
        $utm = strtolower($utmSource ?? '');
        $ref = strtolower($rawReferrer ?? '');

        if (str_contains($utm, 'meta') || str_contains($utm, 'facebook') || str_contains($utm, 'instagram') || str_contains($utm, 'fb') || str_contains($utm, 'ig')) {
            return 'Meta Ads (Campaña)';
        }

        if (str_contains($ref, 'facebook.com') || str_contains($ref, 'instagram.com') || str_contains($ref, 'l.instagram.com') || str_contains($ref, 'fb.me') || str_contains($ref, 'm.facebook.com')) {
            return 'Meta Ads / Redes (Facebook/Instagram)';
        }

        if (str_contains($utm, 'google') || str_contains($utm, 'adwords') || str_contains($utm, 'gads')) {
            return 'Google Ads';
        }

        if (str_contains($ref, 'google.com') || str_contains($ref, 'google.com.ar') || str_contains($ref, 'google.')) {
            return 'Google (Búsqueda Orgánica)';
        }

        if (str_contains($ref, 'whatsapp') || str_contains($ref, 'wa.me')) {
            return 'WhatsApp';
        }

        if (!empty($rawReferrer)) {
            $host = parse_url($rawReferrer, PHP_URL_HOST);
            return $host ?: $rawReferrer;
        }

        return 'Directo / Sin Referrer';
    }

    /**
     * Detecta si es Móvil, Tablet o Escritorio.
     */
    public static function getDeviceType(string $ua): string
    {
        if (preg_match('/(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/i', $ua)) {
            return 'Tablet';
        }
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|windows phone|xda|xiino/i', $ua)) {
            return 'Móvil';
        }
        return 'Escritorio';
    }

    /**
     * Extrae el navegador del User Agent.
     */
    public static function getBrowser(string $ua): string
    {
        if (str_contains($ua, 'FBAN') || str_contains($ua, 'FBAV') || str_contains($ua, 'Instagram')) {
            return 'Meta App Browser';
        }
        if (str_contains($ua, 'Edg/')) return 'Edge';
        if (str_contains($ua, 'Chrome/') && !str_contains($ua, 'Edg/')) return 'Chrome';
        if (str_contains($ua, 'Safari/') && !str_contains($ua, 'Chrome/')) return 'Safari';
        if (str_contains($ua, 'Firefox/')) return 'Firefox';
        if (str_contains($ua, 'OPR/') || str_contains($ua, 'Opera/')) return 'Opera';
        
        return 'Otro';
    }
}
