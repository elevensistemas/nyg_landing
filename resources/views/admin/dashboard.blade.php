@extends('layouts.admin')

@section('title', 'Panel')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="admin-stat-card">
            <span class="admin-stat-number">{{ $stats['quotes_new'] }}</span>
            <span class="admin-stat-label">Cotizaciones nuevas</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stat-card">
            <span class="admin-stat-number">{{ $stats['quotes_total'] }}</span>
            <span class="admin-stat-label">Cotizaciones totales</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stat-card">
            <span class="admin-stat-number">{{ $stats['contacts_new'] }}</span>
            <span class="admin-stat-label">Consultas nuevas</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stat-card">
            <span class="admin-stat-number">{{ $stats['services_published'] }}</span>
            <span class="admin-stat-label">Servicios publicados</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <h2 class="h5">Últimas cotizaciones</h2>
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Empresa</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                    @forelse($latestQuotes as $quote)
                        <tr>
                            <td>{{ $quote->full_name }}</td>
                            <td>{{ $quote->company ?? '—' }}</td>
                            <td><span class="badge-status">{{ \App\Models\QuoteRequest::STATUSES[$quote->status] ?? $quote->status }}</span></td>
                            <td><a href="{{ route('admin.quote-requests.show', $quote) }}">Ver</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Todavía no hay solicitudes de cotización.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-6">
        <h2 class="h5">Últimas consultas de contacto</h2>
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Correo</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                    @forelse($latestContacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td><span class="badge-status">{{ ucfirst($contact->status) }}</span></td>
                            <td><a href="{{ route('admin.contact-requests.show', $contact) }}">Ver</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Todavía no hay consultas de contacto.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
