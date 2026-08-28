@extends('layouts.admin')

@section('title', 'Editar '.$page->title)

@section('content')
<form method="POST" action="{{ route('admin.legal-pages.update', $page) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contenido (HTML permitido)</label>
        <textarea name="content" class="form-control" rows="16">{{ $page->content }}</textarea>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" @checked($page->is_published)>
        <label class="form-check-label" for="published">Publicada</label>
    </div>

    <button type="submit" class="btn btn-cta">Guardar</button>
    <a href="{{ route('admin.legal-pages.index') }}" class="btn btn-outline-dark">Cancelar</a>
</form>
@endsection
