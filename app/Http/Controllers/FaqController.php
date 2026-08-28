<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::published()->get()->groupBy(fn ($faq) => $faq->category ?? 'General');

        return view('faq', compact('faqs'));
    }
}
