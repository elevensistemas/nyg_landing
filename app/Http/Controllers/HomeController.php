<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::allCached();
        $featuredServices = Service::published()->ordered()->where('is_featured_on_home', true)->get();
        $allServices = Service::published()->ordered()->get();
        $clients = Client::published()->get();
        $industries = Industry::published()->orderBy('order')->get();
        $faqs = Faq::published()->limit(6)->get();

        return view('home', compact('settings', 'featuredServices', 'allServices', 'clients', 'industries', 'faqs'));
    }
}
