<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class AdminController extends Controller
{
    protected function renderAdmin(string $template, array $data = [], string $title = 'Panel'): void
    {
        $data['title'] = $title;
        \Flight::render($template, $data, 'content');
        \Flight::render('admin/layout', $data);
    }
}
