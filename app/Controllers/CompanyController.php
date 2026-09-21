<?php

namespace App\Controllers;

use App\Models\Page;

class CompanyController extends Controller
{
    public function show()
    {
        $page = Page::findBySlug('empresa');
        if (!$page) {
            \Flight::notFound();
            return;
        }

        $metaTitle = 'Nosotros — NYG Transporte | Logística Integral';
        $metaDescription = 'Conocé nuestra historia, filosofía operativa y compromiso con el profesionalismo, la seguridad y la ética.';

        $this->render('empresa', compact('page'), $metaTitle, $metaDescription);
    }
}
