<?php

namespace App\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqsRaw = Faq::published();
        $faqs = [];
        foreach ($faqsRaw as $faq) {
            $faqs[$faq['category']][] = $faq;
        }

        $metaTitle = 'Preguntas frecuentes — NYG Transporte';
        $metaDescription = 'Respuestas sobre cobertura, tipos de mercadería, temperatura controlada, seguimiento, almacenamiento y cotizaciones.';

        $this->render('faq', compact('faqs'), $metaTitle, $metaDescription);
    }
}
