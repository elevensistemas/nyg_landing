@extends('layouts.app')

@php
    $metaTitle = 'Página no encontrada — NYG Transporte';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container text-center">
        <p class="eyebrow">Error 404</p>
        <h1>No encontramos esta página</h1>
        <p class="lead-text">La página que buscás no existe o fue movida.</p>
        <a href="{{ route('home') }}" class="btn btn-cta mt-3">Volver al inicio</a>
    </div>
</section>
@endsection
