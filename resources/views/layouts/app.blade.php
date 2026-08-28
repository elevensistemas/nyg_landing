<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $metaTitle ?? 'NYG Transporte — Logística bajo control, de principio a fin' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.' }}">
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NYG Transporte">
    <meta property="og:title" content="{{ $metaTitle ?? 'NYG Transporte' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Logística bajo control. De principio a fin.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="{{ \App\Models\Setting::get('brand_logo_url') }}" type="image/svg+xml">

    {{-- Datos estructurados: TransportationService / LocalBusiness --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'MovingCompany',
        'name' => 'NYG Transporte',
        'url' => url('/'),
        'telephone' => \App\Models\Setting::get('contact_phone_display'),
        'email' => \App\Models\Setting::get('contact_email'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => \App\Models\Setting::get('address'),
            'addressCountry' => 'AR',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    <a class="visually-hidden-focusable skip-link" href="#contenido-principal">Saltar al contenido principal</a>

    @include('partials.header')

    <main id="contenido-principal">
        @include('partials.flash-messages')
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.whatsapp-button')

    @stack('scripts')
</body>
</html>
