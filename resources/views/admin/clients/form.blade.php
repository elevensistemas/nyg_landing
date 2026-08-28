@extends('layouts.admin')

@section('title', $client->exists ? 'Editar cliente' : 'Nuevo cliente')

@section('content')
<form method="POST" action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}" enctype="multipart/form-data" class="col-lg-6">
    @csrf
    @if($client->exists) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Nombre *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Sitio web</label>
        <input type="url" name="website_url" class="form-control" value="{{ old('website_url', $client->website_url) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Logotipo {{ $client->exists ? '' : '*' }}</label>
        <input type="file" name="logo" class="form-control" @unless($client->exists) required @endunless>
        @if($client->exists)
            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" style="height:48px;margin-top:8px;">
        @endif
    </div>
    <div class="mb-3">
        <label class="form-label">Orden</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $client->order ?? 0) }}">
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" @checked(old('is_published', $client->exists ? $client->is_published : true))>
        <label class="form-check-label" for="published">Publicado</label>
    </div>

    <button type="submit" class="btn btn-cta">Guardar</button>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-dark">Cancelar</a>
</form>
@endsection
