<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::orderBy('order')->paginate(config('nyg.admin_per_page'));

        return view('admin.service-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_published'] = true;

        ServiceCategory::create($data);

        return back()->with('success', 'Categoría creada.');
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        $serviceCategory->update($data);

        return back()->with('success', 'Categoría actualizada.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return back()->with('success', 'Categoría eliminada.');
    }
}
