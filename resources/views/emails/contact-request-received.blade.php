@component('mail::message')
# Nueva consulta desde el sitio web

**Nombre:** {{ $contactRequest->name }}
**Correo:** {{ $contactRequest->email }}
@if($contactRequest->phone)
**Teléfono:** {{ $contactRequest->phone }}
@endif

**Mensaje:**

{{ $contactRequest->message }}

@component('mail::button', ['url' => route('admin.contact-requests.show', $contactRequest)])
Ver en el panel
@endcomponent

Recibido el {{ $contactRequest->created_at->format('d/m/Y H:i') }} — NYG Transporte
@endcomponent
