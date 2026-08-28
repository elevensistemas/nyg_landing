@component('mail::message')
# Recibimos tu solicitud, {{ explode(' ', $quote->full_name)[0] }}

Gracias por escribirnos. Un integrante de nuestro equipo va a revisar los datos de tu operación y te va a contactar
a la brevedad para avanzar con la propuesta.

**Resumen de tu solicitud:**

@if($quote->service)
- Servicio: {{ $quote->service->name }}
@elseif($quote->service_type_other)
- Servicio: {{ $quote->service_type_other }}
@endif
@if($quote->origin || $quote->destination)
- Origen / destino: {{ $quote->origin ?? '—' }} → {{ $quote->destination ?? '—' }}
@endif
@if($quote->estimated_date)
- Fecha estimada: {{ $quote->estimated_date->format('d/m/Y') }}
@endif

Si necesitás una respuesta más rápida, también podés escribirnos por WhatsApp.

Saludos,
**NYG Transporte**
@endcomponent
