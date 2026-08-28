@php
    $facebook = \App\Models\Setting::get('facebook_url');
    $instagram = \App\Models\Setting::get('instagram_url');
    $rnpsp = \App\Models\Setting::get('rnpsp', '1117');
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4">
                <div class="footer-brand-container mb-4">
                    <img src="{{ asset('images/logo-nyg.png') }}" alt="NYG Logística Integral" class="footer-logo" height="60">
                </div>
                <p class="footer-text text-white-50">
                    Líderes en logística inteligente, transporte de media y larga distancia, 
                    almacenamiento estratégico y distribución capilar en todo el territorio nacional.
                </p>
                @if($rnpsp)
                    <p class="footer-text small text-muted">R.N.P.S.P {{ $rnpsp }}</p>
                @endif
            </div>

            <div class="col-lg-2 col-6">
                <h2 class="footer-heading">Navegación</h2>
                <ul class="footer-list">
                    <li><a href="{{ route('empresa') }}">Empresa</a></li>
                    <li><a href="{{ route('servicios.index') }}">Servicios</a></li>
                    <li><a href="{{ route('tecnologia') }}">Tecnología y seguimiento</a></li>
                    <li><a href="{{ route('clientes') }}">Clientes</a></li>
                    <li><a href="{{ route('faq') }}">Preguntas frecuentes</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h2 class="footer-heading">Contacto</h2>
                <ul class="footer-list">
                    <li>{{ \App\Models\Setting::get('address') }}</li>
                    <li><a href="mailto:{{ \App\Models\Setting::get('contact_email') }}">{{ \App\Models\Setting::get('contact_email') }}</a></li>
                    <li>{{ \App\Models\Setting::get('contact_phone_display') }}</li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h2 class="footer-heading">Legales</h2>
                <ul class="footer-list">
                    <li><a href="{{ route('legal.show', 'politica-de-privacidad') }}">Política de privacidad</a></li>
                    <li><a href="{{ route('legal.show', 'politica-de-cookies') }}">Política de cookies</a></li>
                    <li><a href="{{ route('legal.show', 'terminos-y-condiciones') }}">Términos y condiciones</a></li>
                </ul>
                <div class="footer-social mt-3">
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" aria-label="Facebook de NYG Transporte">Facebook</a>
                    @endif
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener" aria-label="Instagram de NYG Transporte">Instagram</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} NYG Transporte. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
