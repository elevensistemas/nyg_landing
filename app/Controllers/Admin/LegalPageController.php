<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\LegalPage;

class LegalPageController {
    public function index(Request $request): string {
        return View::render('admin.legal-pages.index', [
            'legalPages' => LegalPage::all(),
            'metaTitle' => 'Páginas Legales — CMS NYG'
        ], 'layouts/admin');
    }

    public function edit(Request $request, int $id): string {
        $page = LegalPage::find($id);
        if (!$page) {
            Response::notFound('Página legal no encontrada.');
        }

        return View::render('admin.legal-pages.edit', [
            'page' => $page,
            'metaTitle' => 'Editar ' . $page['title'] . ' — CMS NYG'
        ], 'layouts/admin');
    }

    public function update(Request $request, int $id): void {
        $title = trim((string)$request->input('title'));
        $content = (string)$request->input('content');

        if (!empty($title) && !empty($content)) {
            LegalPage::update($id, [
                'title' => $title,
                'slug' => $request->input('slug'),
                'content' => $content,
                'meta_title' => $request->input('meta_title', $title),
                'meta_description' => $request->input('meta_description', ''),
                'is_active' => $request->input('is_active', 1) ? 1 : 0
            ]);
            flash('success', 'Página legal actualizada.');
        } else {
            flash('error', 'Título y contenido son requeridos.');
        }

        Response::redirect('/admin/legal-pages');
    }
}
