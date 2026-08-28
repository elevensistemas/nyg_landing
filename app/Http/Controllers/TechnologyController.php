<?php

namespace App\Http\Controllers;

use App\Models\Page;

class TechnologyController extends Controller
{
    public function show()
    {
        $page = Page::where('slug', 'tecnologia-y-seguimiento')->with('sections')->firstOrFail();

        return view('tecnologia', compact('page'));
    }
}
