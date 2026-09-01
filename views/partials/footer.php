<?php
$facebook = \App\Models\Setting::get('facebook_url');
$instagram = \App\Models\Setting::get('instagram_url');
$rnpsp = \App\Models\Setting::get('rnpsp', '1117');
?>

<footer class="site-footer">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4">
                <div class="footer-brand-container mb-4">
                    <img src="<?= asset('images/logo-nyg.png') ?>" alt="NYG Logística Integral" class="footer-logo" height="60">
                </div>
                <p class="footer-text text-white-50">
                    Líderes en logística inteligente, transporte de media y larga distancia, 
                    almacenamiento estratégico y distribución capilar en todo el territorio nacional.
                </p>
                <?php if ($rnpsp): ?>
                    <p class="footer-text small text-muted">R.N.P.S.P <?= e($rnpsp) ?></p>
                <?php endif; ?>
            </div>

            <div class="col-lg-2 col-6">
                <h2 class="footer-heading">Navegación</h2>
                <ul class="footer-list">
                    <li><a href="<?= route('empresa') ?>">Empresa</a></li>
                    <li><a href="<?= route('servicios.index') ?>">Servicios</a></li>
                    <li><a href="<?= route('tecnologia') ?>">Tecnología y seguimiento</a></li>
                    <li><a href="<?= route('clientes') ?>">Clientes</a></li>
                    <li><a href="<?= route('faq') ?>">Preguntas frecuentes</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h2 class="footer-heading">Contacto</h2>
                <ul class="footer-list">
                    <li><?= e(\App\Models\Setting::get('address')) ?></li>
                    <li><a href="mailto:<?= e(\App\Models\Setting::get('contact_email')) ?>"><?= e(\App\Models\Setting::get('contact_email')) ?></a></li>
                    <li><?= e(\App\Models\Setting::get('contact_phone_display')) ?></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h2 class="footer-heading">Legales</h2>
                <ul class="footer-list">
                    <li><a href="<?= route('legal.show', ['legal' => 'politica-de-privacidad']) ?>">Política de privacidad</a></li>
                    <li><a href="<?= route('legal.show', ['legal' => 'politica-de-cookies']) ?>">Política de cookies</a></li>
                    <li><a href="<?= route('legal.show', ['legal' => 'terminos-y-condiciones']) ?>">Términos y condiciones</a></li>
                </ul>
                <div class="footer-social mt-3">
                    <?php if ($facebook): ?>
                        <a href="<?= e($facebook) ?>" target="_blank" rel="noopener" aria-label="Facebook de NYG Transporte">Facebook</a>
                    <?php endif; ?>
                    <?php if ($instagram): ?>
                        <a href="<?= e($instagram) ?>" target="_blank" rel="noopener" aria-label="Instagram de NYG Transporte">Instagram</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> NYG Transporte. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
