<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Industry;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::published();
        $industries = Industry::published();

        $metaTitle = 'Clientes — NYG Transporte';
        $metaDescription = 'Empresas que confiaron en NYG Transporte para sus operaciones de logística, transporte y distribución.';

        $this->render('clientes', compact('clients', 'industries'), $metaTitle, $metaDescription);
    }
}
