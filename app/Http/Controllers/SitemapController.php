<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Genera el sitemap.xml dinámicamente a partir de las rutas públicas y
     * los servicios/páginas legales publicados. No requiere paquetes externos.
     */
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('empresa'), 'priority' => '0.8'],
            ['loc' => route('servicios.index'), 'priority' => '0.9'],
            ['loc' => route('tecnologia'), 'priority' => '0.7'],
            ['loc' => route('clientes'), 'priority' => '0.6'],
            ['loc' => route('faq'), 'priority' => '0.6'],
            ['loc' => route('contacto'), 'priority' => '0.9'],
        ]);

        $urls = $urls->merge(
            Service::published()->get()->map(fn ($s) => [
                'loc' => route('servicios.show', $s), 'priority' => '0.8',
            ])
        );

        $urls = $urls->merge(
            LegalPage::where('is_published', true)->get()->map(fn ($p) => [
                'loc' => route('legal.show', $p), 'priority' => '0.3',
            ])
        );

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
