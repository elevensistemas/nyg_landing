<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel') — Administración NYG Transporte</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">NYG <span>Admin</span></div>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Panel</a>
                <a href="{{ route('admin.quote-requests.index') }}" class="{{ request()->routeIs('admin.quote-requests.*') ? 'active' : '' }}">Cotizaciones</a>
                <a href="{{ route('admin.contact-requests.index') }}" class="{{ request()->routeIs('admin.contact-requests.*') ? 'active' : '' }}">Consultas de contacto</a>
                <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Servicios</a>
                <a href="{{ route('admin.service-categories.index') }}" class="{{ request()->routeIs('admin.service-categories.*') ? 'active' : '' }}">Categorías de servicio</a>
                <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">Clientes</a>
                <a href="{{ route('admin.industries.index') }}" class="{{ request()->routeIs('admin.industries.*') ? 'active' : '' }}">Sectores</a>
                <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">Preguntas frecuentes</a>
                <a href="{{ route('admin.legal-pages.index') }}" class="{{ request()->routeIs('admin.legal-pages.*') ? 'active' : '' }}">Páginas legales</a>
                <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">Configuración</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="admin-logout">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Cerrar sesión</button>
            </form>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <h1>@yield('title', 'Panel')</h1>
                <span class="admin-user">{{ auth()->user()->name }}</span>
            </header>

            <main class="admin-main">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
