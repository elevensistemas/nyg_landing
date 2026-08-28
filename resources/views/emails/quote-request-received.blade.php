@component('mail::message')
# Nueva solicitud de cotización

**Nombre:** {{ $quote->full_name }}
@if($quote->company)
**Empresa:** {{ $quote->company }}
@endif
**Correo:** {{ $quote->email }}
**Teléfono:** {{ $quote->phone }}

@if($quote->service)
**Servicio:** {{ $quote->service->name }}
@elseif($quote->service_type_other)
**Servicio (otro):** {{ $quote->service_type_other }}
@endif

@if($quote->origin || $quote->destination)
**Origen / Destino:** {{ $quote->origin ?? '—' }} → {{ $quote->destination ?? '—' }}
@endif

@if($quote->cargo_type)
**Tipo de mercadería:** {{ $quote->cargo_type }}
@endif

@if($quote->requires_temperature_control)
**Requiere temperatura controlada:** Sí ({{ $quote->temperature_requirement ?? 'sin especificar' }})
@endif

@if($quote->approx_weight_kg)
**Peso aproximado:** {{ $quote->approx_weight_kg }} kg
@endif

@if($quote->approx_volume_m3)
**Volumen aproximado:** {{ $quote->approx_volume_m3 }} m³
@endif

@if($quote->pallets_or_packages)
**Pallets / bultos:** {{ $quote->pallets_or_packages }}
@endif

@if($quote->frequency)
**Frecuencia:** {{ $quote->frequency }}
@endif

@if($quote->estimated_date)
**Fecha estimada:** {{ $quote->estimated_date->format('d/m/Y') }}
@endif

@if($quote->comments)
**Comentarios:**

{{ $quote->comments }}
@endif

@component('mail::button', ['url' => route('admin.quote-requests.show', $quote)])
Ver en el panel
@endcomponent

Recibido el {{ $quote->created_at->format('d/m/Y H:i') }} — NYG Transporte
@endcomponent
