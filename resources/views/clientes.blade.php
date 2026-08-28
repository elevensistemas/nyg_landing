@extends('layouts.app')

@php
    $metaTitle = 'Clientes — NYG Transporte';
    $metaDescription = 'Empresas que confiaron en NYG Transporte para sus operaciones de logística, transporte y distribución.';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Clientes</p>
        <h1>Empresas que confiaron en NYG</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        @if($clients->isNotEmpty())
            <div class="clients-grid">
                @foreach($clients as $client)
                    <div class="clients-grid-item" title="{{ $client->name }}">
                        <img src="{{ $client->logo_url }}" alt="Logo de {{ $client->name }}" loading="lazy" width="160" height="80">
                    </div>
                @endforeach
            </div>
        @else
            <p>Los logotipos de clientes se están cargando desde el panel administrativo.</p>
        @endif
    </div>
</section>

@if($industries->isNotEmpty())
<section class="section-light" data-animate>
    <div class="container">
        <h2 class="mb-4">Sectores atendidos</h2>
        <div class="row g-3">
            @foreach($industries as $industry)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="industry-chip">{{ $industry->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-accent" data-animate>
    <div class="container text-center">
        <h2>¿Tu empresa necesita una solución logística a medida?</h2>
        <a href="{{ route('cotizacion') }}" class="btn btn-cta btn-lg mt-3">Solicitar una propuesta</a>
    </div>
</section>
@endsection
