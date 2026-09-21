<?php

namespace App\Controllers;

use App\Models\LegalPage;

class LegalPageController extends Controller
{
    public function show(string $slug)
    {
        $page = LegalPage::findBySlug($slug);
        if (!$page || empty($page['is_published'])) {
            \Flight::notFound();
            return;
        }

        $this->render('legal/show', compact('page'), $page['title'] . ' — NYG Transporte');
    }
}
