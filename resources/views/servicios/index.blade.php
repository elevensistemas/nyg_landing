@extends('layouts.app')

@php
    $metaTitle = 'Servicios de logística integral — NYG Transporte';
    $metaDescription = 'Transporte terrestre y refrigerado, almacenamiento, distribución, cargas completas, puerta a puerta y gestión aduanera.';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Servicios</p>
        <h1>Soluciones logísticas para cada operación</h1>
        <p class="lead-text">
            Cada servicio está pensado para resolver un problema concreto de transporte, almacenamiento o distribución.
        </p>
    </div>
</section>

@foreach($categories as $category)
    @if($category->services->isNotEmpty())
        <section class="section-light" data-animate>
            <div class="container">
                <h2 class="mb-4">{{ $category->name }}</h2>
                <div class="row g-4">
                    @foreach($category->services as $service)
                        <div class="col-md-6 col-lg-4">
                            <article class="service-card">
                                <h3><a href="{{ route('servicios.show', $service) }}">{{ $service->name }}</a></h3>
                                <p>{{ $service->short_description }}</p>
                                <a href="{{ route('servicios.show', $service) }}" class="service-card-link">Ver detalle &rarr;</a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endforeach

<section class="section-accent" data-animate>
    <div class="container text-center">
        <h2>¿No encontrás el servicio que necesitás?</h2>
        <p class="lead-text">Contanos tu operación y te ayudamos a definir la solución adecuada.</p>
        <a href="{{ route('cotizacion') }}" class="btn btn-cta btn-lg mt-3">Solicitar cotización</a>
    </div>
</section>
@endsection
