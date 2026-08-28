<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::where('is_published', true)
            ->orderBy('order')
            ->with(['services' => fn ($q) => $q->published()->ordered()])
            ->get();

        return view('servicios.index', compact('categories'));
    }

    public function show(Service $servicio)
    {
        abort_unless($servicio->is_published, 404);

        $related = Service::published()
            ->where('id', '!=', $servicio->id)
            ->when($servicio->service_category_id, fn ($q) => $q->where('service_category_id', $servicio->service_category_id))
            ->ordered()
            ->limit(3)
            ->get();

        return view('servicios.show', ['service' => $servicio, 'related' => $related]);
    }
}
