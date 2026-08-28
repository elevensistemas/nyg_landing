<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%'))
            ->with('category')
            ->ordered()
            ->paginate(config('nyg.admin_per_page'))
            ->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('order')->get();

        return view('admin.services.form', ['service' => new Service, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('order')->get();

        return view('admin.services.form', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request, $service->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($request->hasFile('cover_image')) {
            if ($service->cover_image) {
                Storage::disk('public')->delete($service->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'service_category_id' => ['nullable', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'alpha_dash', 'unique:services,slug'.($ignoreId ? ",{$ignoreId}" : '')],
            'problem' => ['nullable', 'string', 'max:300'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_featured_on_home' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }
}
