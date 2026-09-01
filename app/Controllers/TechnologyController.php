<?php

namespace App\Controllers;

use Core\Request;
use Core\View;

class TechnologyController {
    public function show(Request $request): string {
        return View::render('tecnologia', [
            'metaTitle' => 'Tecnología y Seguimiento en Tiempo Real — NYG Transporte',
            'metaDescription' => 'Sistemas de trazabilidad, telemetría y control de flota en tiempo real para máxima visibilidad de tu carga.'
        ]);
    }
}
