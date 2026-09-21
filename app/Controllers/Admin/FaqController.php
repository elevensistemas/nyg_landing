<?php

namespace App\Controllers\Admin;

use App\Models\Faq;

class FaqController extends AdminController
{
    public function index()
    {
        $faqs = Faq::all();

        $this->renderAdmin('admin/faqs/index', compact('faqs'), 'Preguntas frecuentes');
    }

    public function store()
    {
        $data = \Flight::request()->data;
        $question = trim($data->question ?? '');
        $answer = trim($data->answer ?? '');
        $category = trim($data->category ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($question) || empty($answer)) {
            $_SESSION['error'] = 'Pregunta y respuesta son campos obligatorios.';
            \Flight::redirect(route('admin.faqs.index'));
            return;
        }

        Faq::create([
            'question' => $question,
            'answer' => $answer,
            'category' => !empty($category) ? $category : null,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Pregunta creada.';
        \Flight::redirect(route('admin.faqs.index'));
    }

    public function update(int $id)
    {
        $data = \Flight::request()->data;
        $question = trim($data->question ?? '');
        $answer = trim($data->answer ?? '');
        $category = trim($data->category ?? '');
        $order = !empty($data->order) ? (int)$data->order : 0;
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($question) || empty($answer)) {
            $_SESSION['error'] = 'Pregunta y respuesta son campos obligatorios.';
            \Flight::redirect(route('admin.faqs.index'));
            return;
        }

        Faq::update($id, [
            'question' => $question,
            'answer' => $answer,
            'category' => !empty($category) ? $category : null,
            'order' => $order,
            'is_published' => $is_published
        ]);

        $_SESSION['success'] = 'Pregunta actualizada.';
        \Flight::redirect(route('admin.faqs.index'));
    }

    public function destroy(int $id)
    {
        Faq::delete($id);
        $_SESSION['success'] = 'Pregunta eliminada.';
        \Flight::redirect(route('admin.faqs.index'));
    }
}
