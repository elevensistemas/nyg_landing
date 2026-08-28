@extends('layouts.app')

@php
    $metaTitle = 'Contacto — NYG Transporte';
    $metaDescription = 'Escribinos por WhatsApp, correo o completá el formulario de contacto. Te respondemos a la brevedad.';
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', config('services.whatsapp.number'));
    $whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera solicitar información sobre transporte.');
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Contacto</p>
        <h1>Contanos qué necesitás mover. Nosotros diseñamos cómo hacerlo.</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2>Datos de contacto</h2>
                <ul class="contact-list contact-list-light">
                    <li><strong>Teléfono / WhatsApp:</strong> {{ \App\Models\Setting::get('contact_phone_display') }}</li>
                    <li><strong>Correo:</strong> <a href="mailto:{{ \App\Models\Setting::get('contact_email') }}">{{ \App\Models\Setting::get('contact_email') }}</a></li>
                    <li><strong>Dirección:</strong> {{ \App\Models\Setting::get('address') }}</li>
                    @if(\App\Models\Setting::get('business_hours'))
                        <li><strong>Horario:</strong> {{ \App\Models\Setting::get('business_hours') }}</li>
                    @endif
                </ul>
                <a href="{{ $whatsappHref }}" target="_blank" rel="noopener" class="btn btn-whatsapp mb-3">Escribir por WhatsApp</a>

                <div class="map-embed">
                    <iframe
                        title="Ubicación de NYG Transporte"
                        src="https://maps.google.com/maps?q={{ urlencode(\App\Models\Setting::get('address', 'Buenos Aires, Argentina')) }}&t=m&z=15&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="border:0;width:100%;height:280px;border-radius:12px;">
                    </iframe>
                </div>
            </div>

            <div class="col-lg-7">
                <h2>Formulario de contacto</h2>
                <form method="POST" action="{{ route('contacto.store') }}" novalidate data-ajax-form>
                    @csrf
                    {{-- Honeypot anti-spam: campo oculto, no debe completarse --}}
                    <div class="visually-hidden" aria-hidden="true">
                        <label for="website">No completar este campo</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre y apellido *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje *</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input @error('privacy_consent') is-invalid @enderror" type="checkbox" id="privacy_consent" name="privacy_consent" value="1" required>
                        <label class="form-check-label" for="privacy_consent">
                            Acepto la <a href="{{ route('legal.show', 'politica-de-privacidad') }}" target="_blank">política de privacidad</a> para el tratamiento de mis datos.
                        </label>
                        @error('privacy_consent')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-cta">Enviar mensaje</button>
                    <a href="{{ $whatsappHref }}" target="_blank" rel="noopener" class="btn btn-outline-dark ms-2">O escribinos por WhatsApp</a>

                    <div class="form-status mt-3" data-form-status role="status" aria-live="polite"></div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
