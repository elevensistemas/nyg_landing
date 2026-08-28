@extends('layouts.admin')

@section('title', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="d-flex gap-2">
        <input type="search" name="q" class="form-control" placeholder="Buscar servicio..." value="{{ request('q') }}">
        <button class="btn btn-outline-dark" type="submit">Buscar</button>
    </form>
    <a href="{{ route('admin.services.create') }}" class="btn btn-cta">Nuevo servicio</a>
</div>

<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Orden</th><th>Nombre</th><th>Categoría</th><th>Destacado</th><th>Publicado</th><th></th></tr></thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->order }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->category?->name ?? '—' }}</td>
                    <td>{{ $service->is_featured_on_home ? 'Sí' : 'No' }}</td>
                    <td>{{ $service->is_published ? 'Sí' : 'No' }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.services.edit', $service) }}">Editar</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este servicio?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-link-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay servicios cargados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $services->links() }}
@endsection
