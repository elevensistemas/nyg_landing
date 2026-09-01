<?php
use Core\Auth;
$user = Auth::user();
$currentPath = $_SERVER['REQUEST_URI'] ?? '/admin';
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="<?= e(csrf_token()) ?>">
    <title><?= e($metaTitle ?? 'Panel de Administración — NYG Transporte') ?></title>
    <?= vite(['resources/css/app.scss', 'resources/js/app.js']) ?>
</head>
<body class="admin-body">
    <div class="admin-layout">
        <?php if ($user): ?>
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">NYG <span>Admin</span></div>
            <nav class="admin-nav">
                <a href="/admin" class="<?= $currentPath === '/admin' ? 'active' : '' ?>">Panel</a>
                <a href="/admin/quote-requests" class="<?= str_contains($currentPath, 'quote-requests') ? 'active' : '' ?>">Cotizaciones</a>
                <a href="/admin/contact-requests" class="<?= str_contains($currentPath, 'contact-requests') ? 'active' : '' ?>">Consultas de contacto</a>
                <a href="/admin/services" class="<?= str_contains($currentPath, 'services') ? 'active' : '' ?>">Servicios</a>
                <a href="/admin/clients" class="<?= str_contains($currentPath, 'clients') ? 'active' : '' ?>">Clientes</a>
                <a href="/admin/faqs" class="<?= str_contains($currentPath, 'faqs') ? 'active' : '' ?>">Preguntas frecuentes</a>
                <a href="/admin/legal-pages" class="<?= str_contains($currentPath, 'legal-pages') ? 'active' : '' ?>">Páginas legales</a>
                <a href="/admin/settings" class="<?= str_contains($currentPath, 'settings') ? 'active' : '' ?>">Configuración</a>
            </nav>
            <form method="POST" action="/admin/logout" class="admin-logout">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Cerrar sesión</button>
            </form>
        </aside>
        <?php endif; ?>

        <div class="admin-content">
            <?php if ($user): ?>
            <header class="admin-topbar">
                <h1><?= e($metaTitle ?? 'Panel') ?></h1>
                <span class="admin-user"><?= e($user['name'] ?? $user['email']) ?></span>
            </header>
            <?php endif; ?>

            <main class="admin-main container-fluid py-4">
                <?php if ($success = flash('success')): ?>
                    <div class="alert alert-success"><?= e($success) ?></div>
                <?php endif; ?>
                <?php if ($error = flash('error')): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>

                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
</body>
</html>
