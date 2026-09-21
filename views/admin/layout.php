<?php
function isAdminActive(string $path, bool $exact = false): string {
    $currentUrl = $_SERVER['REQUEST_URI'] ?? '/admin';
    $cleanUrl = rtrim($currentUrl, '/');
    $isAdminDashboard = ($cleanUrl === '/admin' || $cleanUrl === '/admin/index.php');
    if ($exact) {
        return $isAdminDashboard ? 'active' : '';
    }
    return (!$isAdminDashboard && str_contains($cleanUrl, $path)) ? 'active' : '';
}
$errors = $_SESSION['_errors'] ?? [];
unset($_SESSION['_errors']);
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= htmlspecialchars($title ?? 'Panel') ?> — Administración NYG Transporte</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <script src="<?= asset('js/app.js') ?>" defer></script>
</head>
<body class="admin-body">
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">NYG <span>Admin</span></div>
            <nav class="admin-nav">
                <a href="<?= route('admin.dashboard') ?>" class="<?= isAdminActive('', true) ? 'active' : '' ?>">Panel</a>
                <a href="<?= route('admin.visits.index') ?>" class="<?= isAdminActive('/admin/visits') ? 'active' : '' ?>">Visitas y Métricas <span style="font-size: 0.75rem; background: #facc15; color: #000; padding: 1px 6px; border-radius: 4px; margin-left: 6px; font-weight: 700;">Live</span></a>
                <a href="<?= route('admin.quote-requests.index') ?>" class="<?= isAdminActive('/admin/quote-requests') ? 'active' : '' ?>">Cotizaciones</a>
                <a href="<?= route('admin.contact-requests.index') ?>" class="<?= isAdminActive('/admin/contact-requests') ? 'active' : '' ?>">Consultas de contacto</a>
                <a href="<?= route('admin.services.index') ?>" class="<?= isAdminActive('/admin/services') ? 'active' : '' ?>">Servicios</a>
                <a href="<?= route('admin.service-categories.index') ?>" class="<?= isAdminActive('/admin/service-categories') ? 'active' : '' ?>">Categorías de servicio</a>
                <a href="<?= route('admin.clients.index') ?>" class="<?= isAdminActive('/admin/clients') ? 'active' : '' ?>">Clientes</a>
                <a href="<?= route('admin.industries.index') ?>" class="<?= isAdminActive('/admin/industries') ? 'active' : '' ?>">Sectores</a>
                <a href="<?= route('admin.faqs.index') ?>" class="<?= isAdminActive('/admin/faqs') ? 'active' : '' ?>">Preguntas frecuentes</a>
                <a href="<?= route('admin.legal-pages.index') ?>" class="<?= isAdminActive('/admin/legal-pages') ? 'active' : '' ?>">Páginas legales</a>
                <a href="<?= route('admin.settings.edit') ?>" class="<?= isAdminActive('/admin/settings') ? 'active' : '' ?>">Configuración</a>
            </nav>
            <form method="POST" action="<?= route('admin.logout') ?>" class="admin-logout">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Cerrar sesión</button>
            </form>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <h1><?= htmlspecialchars($title ?? 'Panel') ?></h1>
                <span class="admin-user"><?= htmlspecialchars($_SESSION['admin_user']['name'] ?? 'Administrador') ?></span>
            </header>

            <main class="admin-main">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <?php if(!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
</body>
</html>
