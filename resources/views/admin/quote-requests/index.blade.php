@extends('layouts.admin')

@section('title', 'Solicitudes de cotización')

@section('content')
<form method="GET" class="d-flex gap-2 mb-3">
    <input type="search" name="q" class="form-control" placeholder="Buscar por nombre, empresa o correo..." value="{{ request('q') }}">
    <select name="status" class="form-select" style="max-width:220px;">
        <option value="">Todos los estados</option>
        @foreach($statuses as $key => $label)
            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <button class="btn btn-outline-dark" type="submit">Filtrar</button>
</form>

<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Fecha</th><th>Nombre</th><th>Empresa</th><th>Servicio</th><th>Estado</th><th></th></tr></thead>
        <tbody>
            @forelse($quotes as $quote)
                <tr class="{{ $quote->read_at ? '' : 'fw-bold' }}">
                    <td>{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $quote->full_name }}</td>
                    <td>{{ $quote->company ?? '—' }}</td>
                    <td>{{ $quote->service?->name ?? $quote->service_type_other ?? '—' }}</td>
                    <td><span class="badge-status">{{ $statuses[$quote->status] ?? $quote->status }}</span></td>
                    <td><a href="{{ route('admin.quote-requests.show', $quote) }}">Ver</a></td>
                </tr>
            @empty
                <tr><td colspan="6">No hay solicitudes de cotización.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $quotes->links() }}
@endsection
