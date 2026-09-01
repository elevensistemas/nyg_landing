<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use App\Models\Client;
use App\Models\Industry;

class ClientController {
    public function index(Request $request): string {
        $clients = Client::allActive();
        $industries = Industry::allActive();

        return View::render('clientes', [
            'clients' => $clients,
            'industries' => $industries,
            'metaTitle' => 'Empresas que confían en nosotros — NYG Transporte',
            'metaDescription' => 'Conoce los testimonios y casos de éxito de las empresas que eligen NYG Transporte para su logística.'
        ]);
    }
}
