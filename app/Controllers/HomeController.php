<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $featuredServices = Service::getFeatured();
        $allServices = Service::published();
        $clients = Client::published();
        $industries = Industry::published();
        $faqs = Faq::published(6);

        $this->render('home', compact('settings', 'featuredServices', 'allServices', 'clients', 'industries', 'faqs'));
    }
}
