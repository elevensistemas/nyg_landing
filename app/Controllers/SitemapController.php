<?php

namespace App\Controllers;

use App\Models\LegalPage;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('empresa'), 'priority' => '0.8'],
            ['loc' => route('servicios.index'), 'priority' => '0.9'],
            ['loc' => route('tecnologia'), 'priority' => '0.7'],
            ['loc' => route('clientes'), 'priority' => '0.6'],
            ['loc' => route('faq'), 'priority' => '0.6'],
            ['loc' => route('contacto'), 'priority' => '0.9'],
        ];

        $services = Service::published();
        foreach ($services as $s) {
            $urls[] = [
                'loc' => route('servicios.show', ['servicio' => $s['slug']]),
                'priority' => '0.8'
            ];
        }

        $legalPages = LegalPage::published();
        foreach ($legalPages as $p) {
            $urls[] = [
                'loc' => route('legal.show', ['legal' => $p['slug']]),
                'priority' => '0.3'
            ];
        }

        header('Content-Type: text/xml; charset=utf-8');
        \Flight::render('sitemap', ['urls' => $urls]);
    }
}
