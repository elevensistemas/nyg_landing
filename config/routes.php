<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\CompanyController;
use App\Controllers\ServiceController;
use App\Controllers\TechnologyController;
use App\Controllers\ClientController;
use App\Controllers\FaqController;
use App\Controllers\ContactController;
use App\Controllers\QuoteController;
use App\Controllers\LegalPageController;
use App\Controllers\SitemapController;
use App\Controllers\DatabaseController;

use App\Controllers\Admin\AuthController as AdminAuthController;
use App\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Controllers\Admin\ServiceController as AdminServiceController;
use App\Controllers\Admin\ClientController as AdminClientController;
use App\Controllers\Admin\FaqController as AdminFaqController;
use App\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Controllers\Admin\ContactRequestController as AdminContactRequestController;
use App\Controllers\Admin\SettingController as AdminSettingController;
use App\Controllers\Admin\LegalPageController as AdminLegalPageController;

return function (Router $router) {
    // Rutas públicas
    $router->get('/', [HomeController::class, 'index'])->name('home');
    $router->get('/empresa', [CompanyController::class, 'show'])->name('empresa');

    $router->get('/servicios', [ServiceController::class, 'index'])->name('servicios.index');
    $router->get('/servicios/{servicio}', [ServiceController::class, 'show'])->name('servicios.show');

    $router->get('/tecnologia-y-seguimiento', [TechnologyController::class, 'show'])->name('tecnologia');
    $router->get('/clientes', [ClientController::class, 'index'])->name('clientes');
    $router->get('/preguntas-frecuentes', [FaqController::class, 'index'])->name('faq');

    $router->get('/contacto', [ContactController::class, 'create'])->name('contacto');
    $router->post('/contacto', [ContactController::class, 'store'])->name('contacto.store');

    $router->get('/cotizacion', [QuoteController::class, 'create'])->name('cotizacion');
    $router->post('/cotizacion', [QuoteController::class, 'store'])->name('cotizacion.store');
    $router->get('/cotizacion/gracias', [QuoteController::class, 'thanks'])->name('cotizacion.gracias');

    $router->get('/legales/{legal}', [LegalPageController::class, 'show'])->name('legal.show');
    $router->get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
    $router->get('/database/seed', [DatabaseController::class, 'seed'])->name('database.seed');

    // Panel de administración
    $router->group(['prefix' => 'admin'], function (Router $router) {
        $router->get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
        $router->post('/login', [AdminAuthController::class, 'login']);

        $router->group(['middleware' => 'auth'], function (Router $router) {
            $router->post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
            $router->get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

            // Servicios Admin
            $router->get('/services', [AdminServiceController::class, 'index']);
            $router->get('/services/create', [AdminServiceController::class, 'create']);
            $router->post('/services', [AdminServiceController::class, 'store']);
            $router->get('/services/{id}/edit', [AdminServiceController::class, 'edit']);
            $router->put('/services/{id}', [AdminServiceController::class, 'update']);
            $router->delete('/services/{id}', [AdminServiceController::class, 'destroy']);

            // FAQs Admin
            $router->get('/faqs', [AdminFaqController::class, 'index']);
            $router->post('/faqs', [AdminFaqController::class, 'store']);
            $router->delete('/faqs/{id}', [AdminFaqController::class, 'destroy']);

            // Clientes Admin
            $router->get('/clients', [AdminClientController::class, 'index']);
            $router->post('/clients', [AdminClientController::class, 'store']);
            $router->delete('/clients/{id}', [AdminClientController::class, 'destroy']);

            // Cotizaciones Admin
            $router->get('/quote-requests', [AdminQuoteRequestController::class, 'index']);
            $router->get('/quote-requests/{id}', [AdminQuoteRequestController::class, 'show']);
            $router->put('/quote-requests/{id}', [AdminQuoteRequestController::class, 'update']);
            $router->delete('/quote-requests/{id}', [AdminQuoteRequestController::class, 'destroy']);

            // Contactos Admin
            $router->get('/contact-requests', [AdminContactRequestController::class, 'index']);
            $router->get('/contact-requests/{id}', [AdminContactRequestController::class, 'show']);
            $router->put('/contact-requests/{id}', [AdminContactRequestController::class, 'update']);
            $router->delete('/contact-requests/{id}', [AdminContactRequestController::class, 'destroy']);

            // Settings Admin
            $router->get('/settings', [AdminSettingController::class, 'edit']);
            $router->put('/settings', [AdminSettingController::class, 'update']);

            // Legales Admin
            $router->get('/legal-pages', [AdminLegalPageController::class, 'index']);
            $router->get('/legal-pages/{id}/edit', [AdminLegalPageController::class, 'edit']);
            $router->put('/legal-pages/{id}', [AdminLegalPageController::class, 'update']);
        });
    });
};
