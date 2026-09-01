<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use App\Models\Faq;

class FaqController {
    public function index(Request $request): string {
        $faqs = Faq::allActive();

        return View::render('faq', [
            'faqs' => $faqs,
            'metaTitle' => 'Preguntas Frecuentes — NYG Transporte',
            'metaDescription' => 'Respuestas a las dudas más comunes sobre nuestros servicios de transporte, cotizaciones y tiempos de entrega.'
        ]);
    }
}
