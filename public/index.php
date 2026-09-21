<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

if (($_ENV['APP_DEBUG'] ?? 'false') === 'true') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

require_once __DIR__ . '/../app/Helpers/functions.php';

Flight::set('flight.views.path', __DIR__ . '/../views');

Flight::map('error', function(\Throwable $ex) {
    echo "<h1>Error: " . htmlspecialchars($ex->getMessage()) . "</h1>";
    echo "<pre>" . htmlspecialchars($ex->getFile() . ':' . $ex->getLine() . "\n" . $ex->getTraceAsString()) . "</pre>";
});

// Global Middleware for CSRF on POST requests and Visit Tracking on GET requests
Flight::before('start', function() {
    \App\Middleware\CsrfMiddleware::check();
    \App\Middleware\VisitTrackerMiddleware::check();
});

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PUBLIC ROUTES
Flight::route('GET /', [App\Controllers\HomeController::class, 'index'], false, 'home');
Flight::route('GET /empresa', [App\Controllers\CompanyController::class, 'show'], false, 'empresa');
Flight::route('GET /servicios', [App\Controllers\ServiceController::class, 'index'], false, 'servicios.index');
Flight::route('GET /servicios/@servicio', [App\Controllers\ServiceController::class, 'show'], false, 'servicios.show');
Flight::route('GET /tecnologia-y-seguimiento', [App\Controllers\TechnologyController::class, 'show'], false, 'tecnologia');
Flight::route('GET /clientes', [App\Controllers\ClientController::class, 'index'], false, 'clientes');
Flight::route('GET /preguntas-frecuentes', [App\Controllers\FaqController::class, 'index'], false, 'faq');

Flight::route('GET /contacto', [App\Controllers\ContactController::class, 'create'], false, 'contacto');
Flight::route('POST /contacto', [App\Controllers\ContactController::class, 'store'], false, 'contacto.store');

Flight::route('GET /cotizacion', [App\Controllers\QuoteController::class, 'create'], false, 'cotizacion');
Flight::route('POST /cotizacion', [App\Controllers\QuoteController::class, 'store'], false, 'cotizacion.store');
Flight::route('GET /cotizacion/gracias', [App\Controllers\QuoteController::class, 'thanks'], false, 'cotizacion.gracias');

Flight::route('GET /legales/@legal', [App\Controllers\LegalPageController::class, 'show'], false, 'legal.show');
Flight::route('GET /sitemap.xml', [App\Controllers\SitemapController::class, 'index'], false, 'sitemap');

// ADMIN ROUTES (Public login / attempt)
Flight::route('GET /admin/login', [App\Controllers\Admin\AuthController::class, 'showLogin'], false, 'admin.login');
Flight::route('POST /admin/login', [App\Controllers\Admin\AuthController::class, 'login'], false, 'admin.login.attempt');

// ADMIN GROUP (Protected by AuthMiddleware)
Flight::group('/admin', function() {
    Flight::route('POST /logout', [App\Controllers\Admin\AuthController::class, 'logout'], false, 'admin.logout');
    Flight::route('GET /', [App\Controllers\Admin\DashboardController::class, 'index'], false, 'admin.dashboard');

    // Visits & Traffic Analytics
    Flight::route('GET /visits', [App\Controllers\Admin\VisitController::class, 'index'], false, 'admin.visits.index');
    Flight::route('GET /visits/@sessionId', [App\Controllers\Admin\VisitController::class, 'show'], false, 'admin.visits.show');

    // Services
    Flight::route('GET /services', [App\Controllers\Admin\ServiceController::class, 'index'], false, 'admin.services.index');
    Flight::route('GET /services/create', [App\Controllers\Admin\ServiceController::class, 'create'], false, 'admin.services.create');
    Flight::route('POST /services', [App\Controllers\Admin\ServiceController::class, 'store'], false, 'admin.services.store');
    Flight::route('GET /services/@id/edit', [App\Controllers\Admin\ServiceController::class, 'edit'], false, 'admin.services.edit');
    Flight::route('POST /services/@id', [App\Controllers\Admin\ServiceController::class, 'update'], false, 'admin.services.update');
    Flight::route('POST /services/@id/delete', [App\Controllers\Admin\ServiceController::class, 'destroy'], false, 'admin.services.destroy');

    // Service Categories
    Flight::route('GET /service-categories', [App\Controllers\Admin\ServiceCategoryController::class, 'index'], false, 'admin.service-categories.index');
    Flight::route('POST /service-categories', [App\Controllers\Admin\ServiceCategoryController::class, 'store'], false, 'admin.service-categories.store');
    Flight::route('POST /service-categories/@id', [App\Controllers\Admin\ServiceCategoryController::class, 'update'], false, 'admin.service-categories.update');
    Flight::route('POST /service-categories/@id/delete', [App\Controllers\Admin\ServiceCategoryController::class, 'destroy'], false, 'admin.service-categories.destroy');

    // Clients
    Flight::route('GET /clients', [App\Controllers\Admin\ClientController::class, 'index'], false, 'admin.clients.index');
    Flight::route('GET /clients/create', [App\Controllers\Admin\ClientController::class, 'create'], false, 'admin.clients.create');
    Flight::route('POST /clients', [App\Controllers\Admin\ClientController::class, 'store'], false, 'admin.clients.store');
    Flight::route('GET /clients/@id/edit', [App\Controllers\Admin\ClientController::class, 'edit'], false, 'admin.clients.edit');
    Flight::route('POST /clients/@id', [App\Controllers\Admin\ClientController::class, 'update'], false, 'admin.clients.update');
    Flight::route('POST /clients/@id/delete', [App\Controllers\Admin\ClientController::class, 'destroy'], false, 'admin.clients.destroy');

    // Industries
    Flight::route('GET /industries', [App\Controllers\Admin\IndustryController::class, 'index'], false, 'admin.industries.index');
    Flight::route('POST /industries', [App\Controllers\Admin\IndustryController::class, 'store'], false, 'admin.industries.store');
    Flight::route('POST /industries/@id', [App\Controllers\Admin\IndustryController::class, 'update'], false, 'admin.industries.update');
    Flight::route('POST /industries/@id/delete', [App\Controllers\Admin\IndustryController::class, 'destroy'], false, 'admin.industries.destroy');

    // FAQs
    Flight::route('GET /faqs', [App\Controllers\Admin\FaqController::class, 'index'], false, 'admin.faqs.index');
    Flight::route('POST /faqs', [App\Controllers\Admin\FaqController::class, 'store'], false, 'admin.faqs.store');
    Flight::route('POST /faqs/@id', [App\Controllers\Admin\FaqController::class, 'update'], false, 'admin.faqs.update');
    Flight::route('POST /faqs/@id/delete', [App\Controllers\Admin\FaqController::class, 'destroy'], false, 'admin.faqs.destroy');

    // Quote Requests
    Flight::route('GET /quote-requests', [App\Controllers\Admin\QuoteRequestController::class, 'index'], false, 'admin.quote-requests.index');
    Flight::route('GET /quote-requests/@id', [App\Controllers\Admin\QuoteRequestController::class, 'show'], false, 'admin.quote-requests.show');
    Flight::route('POST /quote-requests/@id', [App\Controllers\Admin\QuoteRequestController::class, 'update'], false, 'admin.quote-requests.update');
    Flight::route('POST /quote-requests/@id/delete', [App\Controllers\Admin\QuoteRequestController::class, 'destroy'], false, 'admin.quote-requests.destroy');

    // Contact Requests
    Flight::route('GET /contact-requests', [App\Controllers\Admin\ContactRequestController::class, 'index'], false, 'admin.contact-requests.index');
    Flight::route('GET /contact-requests/@id', [App\Controllers\Admin\ContactRequestController::class, 'show'], false, 'admin.contact-requests.show');
    Flight::route('POST /contact-requests/@id', [App\Controllers\Admin\ContactRequestController::class, 'update'], false, 'admin.contact-requests.update');
    Flight::route('POST /contact-requests/@id/delete', [App\Controllers\Admin\ContactRequestController::class, 'destroy'], false, 'admin.contact-requests.destroy');

    // Settings
    Flight::route('GET /settings', [App\Controllers\Admin\SettingController::class, 'edit'], false, 'admin.settings.edit');
    Flight::route('POST /settings', [App\Controllers\Admin\SettingController::class, 'update'], false, 'admin.settings.update');

    // Legal Pages
    Flight::route('GET /legal-pages', [App\Controllers\Admin\LegalPageController::class, 'index'], false, 'admin.legal-pages.index');
    Flight::route('GET /legal-pages/@id/edit', [App\Controllers\Admin\LegalPageController::class, 'edit'], false, 'admin.legal-pages.edit');
    Flight::route('POST /legal-pages/@id', [App\Controllers\Admin\LegalPageController::class, 'update'], false, 'admin.legal-pages.update');
}, [new App\Middleware\AuthMiddleware()]);

Flight::start();
