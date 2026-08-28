@extends('layouts.app')

@php
    $metaTitle = $page->title.' — NYG Transporte';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Legales</p>
        <h1>{{ $page->title }}</h1>
        @if($page->last_reviewed_at)
            <p class="text-muted small">Última revisión: {{ $page->last_reviewed_at->format('d/m/Y') }}</p>
        @endif
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="rich-text legal-content">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
