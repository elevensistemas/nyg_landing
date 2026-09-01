<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use App\Models\Service;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Industry;

class HomeController {
    public function index(Request $request): string {
        $services = Service::featured();
        if (empty($services)) {
            $services = Service::allActive();
        }
        $clients = Client::allActive();
        $faqs = Faq::allActive();
        $industries = Industry::allActive();

        return View::render('home', [
            'services' => $services,
            'clients' => $clients,
            'faqs' => $faqs,
            'industries' => $industries,
            'metaTitle' => 'NYG Transporte — Logística bajo control, de principio a fin',
            'metaDescription' => 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.'
        ]);
    }
}
