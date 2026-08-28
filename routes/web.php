<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\ContactRequestController as AdminContactRequestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\IndustryController as AdminIndustryController;
use App\Http\Controllers\Admin\LegalPageController as AdminLegalPageController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\ServiceCategoryController as AdminServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/empresa', [CompanyController::class, 'show'])->name('empresa');

Route::get('/servicios', [ServiceController::class, 'index'])->name('servicios.index');
Route::get('/servicios/{servicio}', [ServiceController::class, 'show'])->name('servicios.show');

Route::get('/tecnologia-y-seguimiento', [TechnologyController::class, 'show'])->name('tecnologia');
Route::get('/clientes', [ClientController::class, 'index'])->name('clientes');
Route::get('/preguntas-frecuentes', [FaqController::class, 'index'])->name('faq');

Route::get('/contacto', [ContactController::class, 'create'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contacto.store');

Route::get('/cotizacion', [QuoteController::class, 'create'])->name('cotizacion');
Route::post('/cotizacion', [QuoteController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('cotizacion.store');
Route::get('/cotizacion/gracias', [QuoteController::class, 'thanks'])->name('cotizacion.gracias');

Route::get('/legales/{legal}', [LegalPageController::class, 'show'])->name('legal.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Panel administrativo
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])
            ->middleware('throttle:10,1')
            ->name('login.attempt');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('service-categories', AdminServiceCategoryController::class)->except(['show', 'create', 'edit']);
        Route::resource('clients', AdminClientController::class)->except(['show']);
        Route::resource('industries', AdminIndustryController::class)->except(['show', 'create', 'edit']);
        Route::resource('faqs', AdminFaqController::class)->except(['show', 'create', 'edit']);

        Route::get('/quote-requests', [AdminQuoteRequestController::class, 'index'])->name('quote-requests.index');
        Route::get('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'show'])->name('quote-requests.show');
        Route::put('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'update'])->name('quote-requests.update');
        Route::delete('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'destroy'])->name('quote-requests.destroy');

        Route::get('/contact-requests', [AdminContactRequestController::class, 'index'])->name('contact-requests.index');
        Route::get('/contact-requests/{contactRequest}', [AdminContactRequestController::class, 'show'])->name('contact-requests.show');
        Route::put('/contact-requests/{contactRequest}', [AdminContactRequestController::class, 'update'])->name('contact-requests.update');
        Route::delete('/contact-requests/{contactRequest}', [AdminContactRequestController::class, 'destroy'])->name('contact-requests.destroy');

        Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

        Route::get('/legal-pages', [AdminLegalPageController::class, 'index'])->name('legal-pages.index');
        Route::get('/legal-pages/{legalPage}/edit', [AdminLegalPageController::class, 'edit'])->name('legal-pages.edit');
        Route::put('/legal-pages/{legalPage}', [AdminLegalPageController::class, 'update'])->name('legal-pages.update');
    });
});
