<?php

namespace App\Controllers;

use App\Models\Page;

class TechnologyController extends Controller
{
    public function show()
    {
        $page = Page::findBySlug('tecnologia-y-seguimiento');
        if (!$page) {
            \Flight::notFound();
            return;
        }

        $metaTitle = 'Tecnología y seguimiento — NYG Transporte';
        $metaDescription = 'Seguimiento satelital con recupero, visibilidad de las unidades y control operativo durante toda la operación.';

        $this->render('tecnologia', compact('page'), $metaTitle, $metaDescription);
    }
}
