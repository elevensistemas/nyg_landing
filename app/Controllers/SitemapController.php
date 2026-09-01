<?php

namespace App\Controllers;

use Core\Request;
use Core\Response;
use App\Models\Service;
use App\Models\LegalPage;

class SitemapController {
    public function index(Request $request): void {
        $services = Service::allActive();
        $legalPages = LegalPage::allActive();

        header('Content-Type: application/xml; charset=utf-8');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemap.org/schemas/sitemap/0.9">' . "\n";

        $urls = [
            url('/'),
            url('/empresa'),
            url('/servicios'),
            url('/tecnologia-y-seguimiento'),
            url('/clientes'),
            url('/preguntas-frecuentes'),
            url('/contacto'),
            url('/cotizacion'),
        ];

        foreach ($services as $service) {
            $urls[] = url('/servicios/' . $service['slug']);
        }

        foreach ($legalPages as $page) {
            $urls[] = url('/legales/' . $page['slug']);
        }

        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . e($u) . '</loc>' . "\n";
            $xml .= '    <changefreq>weekly</changefreq>' . "\n";
            $xml .= '    <priority>0.8</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        echo $xml;
        exit;
    }
}
