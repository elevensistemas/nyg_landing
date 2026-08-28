@extends('layouts.admin')

@section('title', $service->exists ? 'Editar servicio' : 'Nuevo servicio')

@section('content')
<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Slug (dejar vacío para autogenerar)</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Problema que resuelve</label>
                <input type="text" name="problem" class="form-control" value="{{ old('problem', $service->problem) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción corta (para tarjetas) *</label>
                <textarea name="short_description" class="form-control" rows="2" required>{{ old('short_description', $service->short_description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción completa *</label>
                <textarea name="description" class="form-control" rows="6" required>{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Beneficios (uno por línea)</label>
                <textarea name="benefits" class="form-control" rows="4">{{ old('benefits', $service->benefits) }}</textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="service_category_id" class="form-select">
                    <option value="">Sin categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('service_category_id', $service->service_category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ícono (nombre lineal)</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen de portada</label>
                <input type="file" name="cover_image" class="form-control">
                @if($service->cover_image)
                    <div class="form-text">Actual: {{ $service->cover_image }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Orden</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $service->order ?? 0) }}">
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="is_featured_on_home" value="1" id="featured" @checked(old('is_featured_on_home', $service->is_featured_on_home))>
                <label class="form-check-label" for="featured">Destacado en Inicio</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" @checked(old('is_published', $service->exists ? $service->is_published : true))>
                <label class="form-check-label" for="published">Publicado</label>
            </div>

            <button type="submit" class="btn btn-cta w-100">Guardar</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-dark w-100 mt-2">Cancelar</a>
        </div>
    </div>
</form>
@endsection
