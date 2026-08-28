<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    public function index()
    {
        $pages = LegalPage::orderBy('title')->get();

        return view('admin.legal-pages.index', compact('pages'));
    }

    public function edit(LegalPage $legalPage)
    {
        return view('admin.legal-pages.form', ['page' => $legalPage]);
    }

    public function update(Request $request, LegalPage $legalPage)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $data['last_reviewed_at'] = now();

        $legalPage->update($data);

        return redirect()->route('admin.legal-pages.index')->with('success', 'Página legal actualizada.');
    }
}
