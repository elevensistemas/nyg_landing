<?php

namespace App\Http\Controllers;

use App\Models\Page;

class CompanyController extends Controller
{
    public function show()
    {
        $page = Page::where('slug', 'empresa')->with('sections')->firstOrFail();

        return view('empresa', compact('page'));
    }
}
