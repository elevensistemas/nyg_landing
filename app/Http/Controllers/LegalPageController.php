<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;

class LegalPageController extends Controller
{
    public function show(LegalPage $legal)
    {
        abort_unless($legal->is_published, 404);

        return view('legal.show', ['page' => $legal]);
    }
}
