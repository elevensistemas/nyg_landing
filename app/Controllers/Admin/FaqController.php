<?php

namespace App\Controllers\Admin;

use Core\Request;
use Core\View;
use Core\Response;
use App\Models\Faq;

class FaqController {
    public function index(Request $request): string {
        return View::render('admin.faqs.index', [
            'faqs' => Faq::all(),
            'metaTitle' => 'Gestión de FAQs — CMS NYG'
        ], 'layouts/admin');
    }

    public function store(Request $request): void {
        $question = trim((string)$request->input('question'));
        $answer = trim((string)$request->input('answer'));

        if (!empty($question) && !empty($answer)) {
            Faq::create([
                'category' => $request->input('category', 'General'),
                'question' => $question,
                'answer' => $answer,
                'is_active' => $request->input('is_active', 1) ? 1 : 0,
                'sort_order' => (int)$request->input('sort_order', 0)
            ]);
            flash('success', 'Pregunta frecuente agregada exitosamente.');
        } else {
            flash('error', 'Pregunta y respuesta son obligatorias.');
        }

        Response::redirect('/admin/faqs');
    }

    public function destroy(Request $request, int $id): void {
        Faq::delete($id);
        flash('success', 'Pregunta frecuente eliminada.');
        Response::redirect('/admin/faqs');
    }
}
