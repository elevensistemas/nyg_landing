<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::orderBy('order')->paginate(config('nyg.admin_per_page'));

        return view('admin.industries.index', compact('industries'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']);

        Industry::create($data);

        return back()->with('success', 'Sector creado. Recordá que solo debe publicarse si está confirmado por NYG.');
    }

    public function update(Request $request, Industry $industry)
    {
        $industry->update($this->validated($request));

        return back()->with('success', 'Sector actualizado.');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();

        return back()->with('success', 'Sector eliminado.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
