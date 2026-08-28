<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(config('nyg.admin_per_page'));

        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        Faq::create($this->validated($request));

        return back()->with('success', 'Pregunta creada.');
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update($this->validated($request));

        return back()->with('success', 'Pregunta actualizada.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', 'Pregunta eliminada.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:2000'],
            'category' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
