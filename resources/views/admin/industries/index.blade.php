@extends('layouts.admin')

@section('title', 'Sectores')

@section('content')
<p class="mb-3">Publicá únicamente sectores confirmados por NYG. No inventar industrias no verificadas.</p>

<div class="row">
    <div class="col-lg-5">
        <h2 class="h6">Nuevo sector</h2>
        <form method="POST" action="{{ route('admin.industries.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="new_published">
                <label class="form-check-label" for="new_published">Publicar (solo si está confirmado)</label>
            </div>
            <button type="submit" class="btn btn-cta">Crear</button>
        </form>
    </div>

    <div class="col-lg-7">
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Publicado</th><th></th></tr></thead>
                <tbody>
                    @forelse($industries as $industry)
                        <tr>
                            <form method="POST" action="{{ route('admin.industries.update', $industry) }}">
                                @csrf @method('PUT')
                                <td><input type="text" name="name" class="form-control form-control-sm" value="{{ $industry->name }}"></td>
                                <td><input type="checkbox" name="is_published" value="1" @checked($industry->is_published)></td>
                                <td class="text-end">
                                    <button type="submit" class="btn btn-sm btn-outline-dark">Guardar</button>
                                </td>
                            </form>
                            <td>
                                <form method="POST" action="{{ route('admin.industries.destroy', $industry) }}" onsubmit="return confirm('¿Eliminar?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-link-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay sectores cargados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
