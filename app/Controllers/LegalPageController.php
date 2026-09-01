<?php

namespace App\Controllers;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\LegalPage;

class LegalPageController {
    public function show(Request $request, string $slug): string {
        $page = LegalPage::findBySlug($slug);
        if (!$page) {
            Response::notFound('Página legal no encontrada.');
        }

        return View::render('legal.show', [
            'page' => $page,
            'metaTitle' => ($page['meta_title'] ?: $page['title']) . ' — NYG Transporte',
            'metaDescription' => $page['meta_description'] ?? ''
        ]);
    }
}
