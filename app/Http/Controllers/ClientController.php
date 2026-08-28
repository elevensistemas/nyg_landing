<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Industry;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::published()->get();
        $industries = Industry::published()->orderBy('order')->get();

        return view('clientes', compact('clients', 'industries'));
    }
}
