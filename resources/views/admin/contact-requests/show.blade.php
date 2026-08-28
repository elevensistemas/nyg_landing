@extends('layouts.admin')

@section('title', 'Consulta de '.$contact->name)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-detail-card">
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $contact->name }}</dd>
                <dt class="col-sm-3">Correo</dt><dd class="col-sm-9"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>
                <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9">{{ $contact->phone ?? '—' }}</dd>
            </dl>
            <h2 class="h5">Mensaje</h2>
            <p>{{ $contact->message }}</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-detail-card">
            <form method="POST" action="{{ route('admin.contact-requests.update', $contact) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="nuevo" @selected($contact->status === 'nuevo')>Nuevo</option>
                        <option value="leido" @selected($contact->status === 'leido')>Leído</option>
                        <option value="respondido" @selected($contact->status === 'respondido')>Respondido</option>
                        <option value="descartado" @selected($contact->status === 'descartado')>Descartado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-cta w-100">Guardar</button>
            </form>
            <form method="POST" action="{{ route('admin.contact-requests.destroy', $contact) }}" class="mt-2" onsubmit="return confirm('¿Eliminar esta consulta?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
