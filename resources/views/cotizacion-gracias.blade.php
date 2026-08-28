@extends('layouts.app')

@php
    $metaTitle = 'Solicitud recibida — NYG Transporte';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container text-center">
        <p class="eyebrow">Gracias</p>
        <h1>Recibimos tu solicitud</h1>
        <p class="lead-text">
            Un integrante de nuestro equipo va a revisar los datos de tu operación y te va a contactar a la brevedad.
            También recibiste un correo de confirmación.
        </p>
        <a href="{{ route('home') }}" class="btn btn-outline-dark mt-3">Volver al inicio</a>
    </div>
</section>
@endsection
