<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use App\Models\Service;
use App\Models\QuoteRequest;
use App\Models\ContactRequest;
use App\Models\Client;

class DashboardController {
    public function index(Request $request): string {
        $servicesCount = count(Service::all());
        $quoteRequestsCount = count(QuoteRequest::all());
        $contactRequestsCount = count(ContactRequest::all());
        $clientsCount = count(Client::all());

        $latestQuotes = array_slice(QuoteRequest::all(), 0, 5);
        $latestContacts = array_slice(ContactRequest::all(), 0, 5);

        return View::render('admin.dashboard', [
            'servicesCount' => $servicesCount,
            'quoteRequestsCount' => $quoteRequestsCount,
            'contactRequestsCount' => $contactRequestsCount,
            'clientsCount' => $clientsCount,
            'latestQuotes' => $latestQuotes,
            'latestContacts' => $latestContacts,
            'metaTitle' => 'Dashboard — Panel Administrativo NYG'
        ], 'layouts/admin');
    }
}
