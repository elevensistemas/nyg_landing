<?php

namespace App\Controllers;

use Core\Request;
use Core\View;

class CompanyController {
    public function show(Request $request): string {
        return View::render('empresa', [
            'metaTitle' => 'Sobre Nosotros — NYG Transporte',
            'metaDescription' => 'Conoce nuestra historia, valores y el equipo detrás de las soluciones de transporte y logística de NYG Transporte.'
        ]);
    }
}
