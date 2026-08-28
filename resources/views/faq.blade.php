@extends('layouts.app')

@php
    $metaTitle = 'Preguntas frecuentes — NYG Transporte';
    $metaDescription = 'Respuestas sobre cobertura, tipos de mercadería, temperatura controlada, seguimiento, almacenamiento y cotizaciones.';
@endphp

@section('content')
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Ayuda</p>
        <h1>Preguntas frecuentes</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        @foreach($faqs as $category => $items)
            <h2 class="mb-3">{{ $category }}</h2>
            <div class="accordion mb-5" id="faq-{{ \Illuminate\Support\Str::slug($category) }}">
                @foreach($items as $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-{{ $faq->id }}" aria-expanded="false" aria-controls="faq-item-{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h3>
                        <div id="faq-item-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faq-{{ \Illuminate\Support\Str::slug($category) }}">
                            <div class="accordion-body">{{ $faq->answer }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- Schema.org FAQPage para SEO --}}
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqs->flatten()->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq->answer],
            ])->values(),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
    </div>
</section>
@endsection
