@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="mb-0">Solo se publican los clientes ya confirmados por NYG. No agregar clientes nuevos sin autorización.</p>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-cta">Nuevo cliente</a>
</div>

<div class="clients-admin-grid">
    @forelse($clients as $client)
        <div class="clients-admin-item">
            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" onerror="this.style.opacity=0.2">
            <p>{{ $client->name }}</p>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route('admin.clients.edit', $client) }}">Editar</a>
                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('¿Eliminar este cliente?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-link-danger">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p>No hay clientes cargados.</p>
    @endforelse
</div>

{{ $clients->links() }}
@endsection
