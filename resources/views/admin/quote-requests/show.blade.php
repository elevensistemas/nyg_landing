@extends('layouts.admin')

@section('title', 'Solicitud de '.$quote->full_name)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-detail-card">
            <h2 class="h5">Datos de contacto</h2>
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $quote->full_name }}</dd>
                <dt class="col-sm-3">Empresa</dt><dd class="col-sm-9">{{ $quote->company ?? '—' }}</dd>
                <dt class="col-sm-3">Correo</dt><dd class="col-sm-9"><a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></dd>
                <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9">{{ $quote->phone }}</dd>
            </dl>

            <h2 class="h5">Detalle de la operación</h2>
            <dl class="row">
                <dt class="col-sm-3">Servicio</dt><dd class="col-sm-9">{{ $quote->service?->name ?? $quote->service_type_other ?? '—' }}</dd>
                <dt class="col-sm-3">Origen</dt><dd class="col-sm-9">{{ $quote->origin ?? '—' }}</dd>
                <dt class="col-sm-3">Destino</dt><dd class="col-sm-9">{{ $quote->destination ?? '—' }}</dd>
                <dt class="col-sm-3">Mercadería</dt><dd class="col-sm-9">{{ $quote->cargo_type ?? '—' }}</dd>
                <dt class="col-sm-3">Temperatura</dt><dd class="col-sm-9">{{ $quote->requires_temperature_control ? ($quote->temperature_requirement ?? 'Sí') : 'No' }}</dd>
                <dt class="col-sm-3">Peso aprox.</dt><dd class="col-sm-9">{{ $quote->approx_weight_kg ? $quote->approx_weight_kg.' kg' : '—' }}</dd>
                <dt class="col-sm-3">Volumen aprox.</dt><dd class="col-sm-9">{{ $quote->approx_volume_m3 ? $quote->approx_volume_m3.' m³' : '—' }}</dd>
                <dt class="col-sm-3">Pallets/bultos</dt><dd class="col-sm-9">{{ $quote->pallets_or_packages ?? '—' }}</dd>
                <dt class="col-sm-3">Frecuencia</dt><dd class="col-sm-9">{{ $quote->frequency ?? '—' }}</dd>
                <dt class="col-sm-3">Fecha estimada</dt><dd class="col-sm-9">{{ optional($quote->estimated_date)->format('d/m/Y') ?? '—' }}</dd>
            </dl>

            @if($quote->comments)
                <h2 class="h5">Comentarios</h2>
                <p>{{ $quote->comments }}</p>
            @endif

            @if($quote->attachments->isNotEmpty())
                <h2 class="h5">Adjuntos</h2>
                <ul>
                    @foreach($quote->attachments as $attachment)
                        <li><a href="{{ asset('storage/'.$attachment->path) }}" target="_blank">{{ $attachment->original_name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-detail-card">
            <h2 class="h5">Gestión de la oportunidad</h2>
            <form method="POST" action="{{ route('admin.quote-requests.update', $quote) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" @selected($quote->status === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notas internas</label>
                    <textarea name="internal_notes" class="form-control" rows="4">{{ $quote->internal_notes }}</textarea>
                </div>
                <button type="submit" class="btn btn-cta w-100">Guardar</button>
            </form>

            <form method="POST" action="{{ route('admin.quote-requests.destroy', $quote) }}" class="mt-2" onsubmit="return confirm('¿Eliminar esta solicitud?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100">Eliminar solicitud</button>
            </form>
        </div>
    </div>
</div>
@endsection
