@extends('layouts.app')

@php
    $metaTitle = 'Tecnología y seguimiento — NYG Transporte';
    $metaDescription = 'Seguimiento satelital con recupero, visibilidad de las unidades y control operativo durante toda la operación.';
    $intro = $page->section('intro');
@endphp

@section('content')
<section class="page-hero page-hero-dark" data-animate>
    <div class="container">
        <p class="eyebrow">Tecnología</p>
        <h1>{{ $intro?->title ?? 'Cada envío visible. Cada decisión respaldada.' }}</h1>
        <p class="lead-text lead-text-light">{{ $intro?->body }}</p>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="diff-card">
                    <h3>Seguimiento satelital</h3>
                    <p>Todas las unidades cuentan con sistemas de seguimiento satelital con recupero.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="diff-card">
                    <h3>Visibilidad del envío</h3>
                    <p>El cliente puede visualizar el estado de su unidad en tiempo real durante la operación.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="diff-card">
                    <h3>Comunicación del estado</h3>
                    <p>Mantenemos informado al cliente sobre el estado de su envío en cada etapa del proceso.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="diff-card">
                    <h3>Reacción ante imprevistos</h3>
                    <p>El control operativo permite reaccionar rápido ante cualquier eventualidad durante el trayecto.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-dark" data-animate>
    <div class="container">
        <div class="control-panel-mock" aria-hidden="true" style="background-image: url('{{ \App\Models\Setting::get('hero_slide_3_image') }}'); min-height: 420px;">
            <div class="control-panel-mock-note">
                Ilustración demostrativa del panel de seguimiento. No representa datos reales de clientes ni ubicaciones de vehículos.
            </div>
        </div>
    </div>
</section>

<section class="section-accent" data-animate>
    <div class="container text-center">
        <h2>Coordiná tu próxima operación con seguimiento en tiempo real</h2>
        <a href="{{ route('cotizacion') }}" class="btn btn-cta btn-lg mt-3">Solicitar cotización</a>
    </div>
</section>
@endsection
