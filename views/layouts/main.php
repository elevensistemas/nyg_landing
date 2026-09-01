<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= e(csrf_token()) ?>">

    <title><?= e($metaTitle ?? 'NYG Transporte — Logística bajo control, de principio a fin') ?></title>
    <meta name="description" content="<?= e($metaDescription ?? 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.') ?>">
    <link rel="canonical" href="<?= e($canonicalUrl ?? url($_SERVER['REQUEST_URI'] ?? '/')) ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NYG Transporte">
    <meta property="og:title" content="<?= e($metaTitle ?? 'NYG Transporte') ?>">
    <meta property="og:description" content="<?= e($metaDescription ?? 'Logística bajo control. De principio a fin.') ?>">
    <meta property="og:url" content="<?= e(url($_SERVER['REQUEST_URI'] ?? '/')) ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="<?= e(asset('images/logo-nyg.png')) ?>" type="image/png">

    <?php /* Structured Data Schema */ ?>
    <script type="application/ld+json">
    <?= json_encode([
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
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>

    <?= vite(['resources/css/app.scss', 'resources/js/app.js']) ?>
</head>
<body>
    <a class="visually-hidden-focusable skip-link" href="#contenido-principal">Saltar al contenido principal</a>

    <?= \Core\View::partial('partials/header') ?>

    <main id="contenido-principal">
        <?= \Core\View::partial('partials/flash-messages') ?>
        <?= $content ?? '' ?>
    </main>

    <?= \Core\View::partial('partials/footer') ?>
    <?= \Core\View::partial('partials/whatsapp-button') ?>
</body>
</html>
