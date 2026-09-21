<?php

namespace App\Controllers\Admin;

use App\Models\LegalPage;

class LegalPageController extends AdminController
{
    public function index()
    {
        $pages = LegalPage::all();

        $this->renderAdmin('admin/legal-pages/index', compact('pages'), 'Páginas legales');
    }

    public function edit(int $id)
    {
        $page = LegalPage::find($id);
        if (!$page) {
            \Flight::notFound();
            return;
        }

        $this->renderAdmin('admin/legal-pages/form', compact('page'), 'Editar página legal');
    }

    public function update(int $id)
    {
        $page = LegalPage::find($id);
        if (!$page) {
            \Flight::notFound();
            return;
        }

        $data = \Flight::request()->data;
        $title = trim($data->title ?? '');
        $content = trim($data->content ?? '');
        $is_published = !empty($data->is_published) ? 1 : 0;

        if (empty($title) || empty($content)) {
            $_SESSION['error'] = 'El título y el contenido son obligatorios.';
            \Flight::redirect(route('admin.legal-pages.edit', ['id' => $id]));
            return;
        }

        LegalPage::update($id, [
            'title' => $title,
            'content' => $content,
            'is_published' => $is_published,
            'last_reviewed_at' => date('Y-m-d H:i:s')
        ]);

        $_SESSION['success'] = 'Página legal actualizada.';
        \Flight::redirect(route('admin.legal-pages.index'));
    }
}
