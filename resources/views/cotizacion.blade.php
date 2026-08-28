@extends('layouts.app')

@php
    $metaTitle = 'Solicitar cotización — NYG Transporte';
    $metaDescription = 'Contanos los datos de tu operación y te enviamos una propuesta de transporte, almacenamiento o distribución.';
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', config('services.whatsapp.number'));
    $whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera cotizar una operación logística.');
    $preselected = request()->query('servicio');
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Cotización</p>
        <h1>Solicitá tu cotización</h1>
        <p class="lead-text">
            Completá los datos que tengas disponibles. Ningún campo operativo es obligatorio salvo tus datos de contacto:
            cuanta más información nos des, más precisa va a ser la propuesta.
        </p>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <form method="POST" action="{{ route('cotizacion.store') }}" enctype="multipart/form-data" novalidate data-quote-form>
                    @csrf
                    <div class="visually-hidden" aria-hidden="true">
                        <label for="website">No completar este campo</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>

                    {{-- Paso 1: Datos de contacto --}}
                    <fieldset class="form-step" data-step="1">
                        <legend>1. Tus datos de contacto</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Nombre y apellido *</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Empresa</label>
                                <input type="text" class="form-control" id="company" name="company" value="{{ old('company') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo electrónico *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono *</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Paso 2: Detalle de la operación --}}
                    <fieldset class="form-step" data-step="2">
                        <legend>2. Detalle de la operación</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="service_id" class="form-label">Tipo de servicio</label>
                                <select class="form-select" id="service_id" name="service_id">
                                    <option value="">Seleccionar...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" @selected(old('service_id', $preselected) == $service->id || old('service_id') == $service->id)>{{ $service->name }}</option>
                                    @endforeach
                                    <option value="">Otro (especificar abajo)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_type_other" class="form-label">Otro servicio (si no está en la lista)</label>
                                <input type="text" class="form-control" id="service_type_other" name="service_type_other" value="{{ old('service_type_other') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="origin" class="form-label">Origen</label>
                                <input type="text" class="form-control" id="origin" name="origin" value="{{ old('origin') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destino</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cargo_type" class="form-label">Tipo de mercadería</label>
                                <input type="text" class="form-control" id="cargo_type" name="cargo_type" value="{{ old('cargo_type') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="requires_temperature_control" name="requires_temperature_control" value="1" @checked(old('requires_temperature_control'))>
                                    <label class="form-check-label" for="requires_temperature_control">Requiere temperatura controlada</label>
                                </div>
                                <input type="text" class="form-control mt-2" id="temperature_requirement" name="temperature_requirement" placeholder="Ej: congelado, supercongelado, refrigerado" value="{{ old('temperature_requirement') }}">
                            </div>
                        </div>
                    </fieldset>

                    {{-- Paso 3: Volumen y frecuencia --}}
                    <fieldset class="form-step" data-step="3">
                        <legend>3. Volumen y frecuencia</legend>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="approx_weight_kg" class="form-label">Peso aproximado (kg)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="approx_weight_kg" name="approx_weight_kg" value="{{ old('approx_weight_kg') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="approx_volume_m3" class="form-label">Volumen aproximado (m³)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="approx_volume_m3" name="approx_volume_m3" value="{{ old('approx_volume_m3') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pallets_or_packages" class="form-label">Cantidad de pallets o bultos</label>
                                <input type="number" min="0" class="form-control" id="pallets_or_packages" name="pallets_or_packages" value="{{ old('pallets_or_packages') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="frequency" class="form-label">Frecuencia del servicio</label>
                                <select class="form-select" id="frequency" name="frequency">
                                    <option value="">Seleccionar...</option>
                                    <option value="Única vez" @selected(old('frequency') === 'Única vez')>Única vez</option>
                                    <option value="Semanal" @selected(old('frequency') === 'Semanal')>Semanal</option>
                                    <option value="Quincenal" @selected(old('frequency') === 'Quincenal')>Quincenal</option>
                                    <option value="Mensual" @selected(old('frequency') === 'Mensual')>Mensual</option>
                                    <option value="Recurrente / a definir" @selected(old('frequency') === 'Recurrente / a definir')>Recurrente / a definir</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estimated_date" class="form-label">Fecha estimada</label>
                                <input type="date" class="form-control @error('estimated_date') is-invalid @enderror" id="estimated_date" name="estimated_date" value="{{ old('estimated_date') }}">
                                @error('estimated_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Paso 4: Comentarios y adjunto --}}
                    <fieldset class="form-step" data-step="4">
                        <legend>4. Comentarios y adjunto</legend>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comentarios</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4">{{ old('comments') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Archivo adjunto (opcional)</label>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment">
                            <div class="form-text">PDF, imagen, Excel o Word. Máximo 5 MB.</div>
                            @error('attachment')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input @error('privacy_consent') is-invalid @enderror" type="checkbox" id="privacy_consent" name="privacy_consent" value="1" required>
                            <label class="form-check-label" for="privacy_consent">
                                Acepto la <a href="{{ route('legal.show', 'politica-de-privacidad') }}" target="_blank">política de privacidad</a> para el tratamiento de mis datos.
                            </label>
                            @error('privacy_consent')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </fieldset>

                    <div class="form-step-nav">
                        <button type="button" class="btn btn-outline-dark" data-step-prev>Anterior</button>
                        <button type="button" class="btn btn-cta" data-step-next>Siguiente</button>
                        <button type="submit" class="btn btn-cta" data-step-submit style="display:none;">Enviar solicitud</button>
                    </div>

                    <p class="mt-3">
                        ¿Preferís hablar directamente? <a href="{{ $whatsappHref }}" target="_blank" rel="noopener">Continuar por WhatsApp</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
