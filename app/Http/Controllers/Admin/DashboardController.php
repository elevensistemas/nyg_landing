<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\QuoteRequest;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'quotes_new' => QuoteRequest::where('status', 'nueva')->count(),
            'quotes_total' => QuoteRequest::count(),
            'contacts_new' => ContactRequest::where('status', 'nuevo')->count(),
            'services_published' => Service::where('is_published', true)->count(),
        ];

        $latestQuotes = QuoteRequest::latest()->limit(5)->get();
        $latestContacts = ContactRequest::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'latestQuotes', 'latestContacts'));
    }
}
