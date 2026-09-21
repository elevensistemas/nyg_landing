<?php
use App\Models\Setting;
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_token() ?>">

    <title><?= htmlspecialchars($metaTitle ?? 'NYG Transporte — Logística inteligente y control absoluto | Argentina') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl ?? asset($_SERVER['REQUEST_URI'])) ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NYG Transporte">
    <meta property="og:title" content="<?= htmlspecialchars($metaTitle ?? 'NYG Transporte') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? 'Logística bajo control. De principio a fin.') ?>">
    <meta property="og:url" content="<?= htmlspecialchars(asset($_SERVER['REQUEST_URI'])) ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="<?= htmlspecialchars((string)Setting::get('brand_logo_url', '/favicon.ico')) ?>" type="image/svg+xml">

    <?php // Datos estructurados: TransportationService / LocalBusiness ?>
    <script type="application/ld+json">
    <?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'MovingCompany',
        'name' => 'NYG Transporte',
        'url' => asset('/'),
        'telephone' => Setting::get('contact_phone_display'),
        'email' => Setting::get('contact_email'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => Setting::get('address'),
            'addressCountry' => 'AR',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>

    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <script src="<?= asset('js/app.js') ?>" defer></script>
    <?= $head ?? '' ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KH9PLBBW');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KH9PLBBW"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <a class="visually-hidden-focusable skip-link" href="#contenido-principal">Saltar al contenido principal</a>

    <?php include __DIR__ . '/partials/header.php'; ?>

    <main id="contenido-principal">
        <?php include __DIR__ . '/partials/flash-messages.php'; ?>
        <?= $content ?? '' ?>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    <?php include __DIR__ . '/partials/whatsapp-button.php'; ?>

    <?= $scripts ?? '' ?>
</body>
</html>
