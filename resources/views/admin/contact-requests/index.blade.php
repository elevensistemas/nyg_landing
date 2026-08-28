@extends('layouts.admin')

@section('title', 'Consultas de contacto')

@section('content')
<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Fecha</th><th>Nombre</th><th>Correo</th><th>Estado</th><th></th></tr></thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr class="{{ $contact->read_at ? '' : 'fw-bold' }}">
                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td><span class="badge-status">{{ ucfirst($contact->status) }}</span></td>
                    <td><a href="{{ route('admin.contact-requests.show', $contact) }}">Ver</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No hay consultas de contacto.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $contacts->links() }}
@endsection
