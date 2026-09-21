<?php

namespace App\Controllers;

class Controller
{
    protected function render(string $template, array $data = [], ?string $title = null, ?string $description = null): void
    {
        $data['metaTitle'] = $title;
        $data['metaDescription'] = $description;
        
        \Flight::render($template, $data, 'content');
        \Flight::render('layout', $data);
    }

    protected function json(array $data, int $code = 200): void
    {
        \Flight::json($data, $code);
    }
}
