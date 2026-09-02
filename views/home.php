<?php
$imageMap = [
    'transporte-terrestre' => asset('images/service-terrestre.jpg'),
    'cross-docking' => asset('images/service-crossdocking.jpg'),
    'almacenamiento' => asset('images/service-almacenamiento.jpg'),
    'distribucion' => asset('images/service-distribucion.jpg'),
    'cargas-completas' => asset('images/service-completo.jpg'),
    'servicios-puerta-a-puerta' => asset('images/service-puerta.jpg'),
];
?>

<!-- 1. HERO CAROUSEL -->
<section class="hero-premium">
    <div class="hero-mouse-glow" aria-hidden="true"></div>
    <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="8000">
        <div class="carousel-indicators" style="bottom: 2rem; z-index: 12;">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner h-100">
            <!-- Slide 1: Logística Integral con Video -->
            <div class="carousel-item active h-100">
                <div class="hero-slide-premium" style="background-image: url('<?= asset('images/hero-tech.jpg') ?>');">
                    <video autoplay loop muted playsinline class="hero-video-bg">
                        <source src="<?= asset('videos/nyg-video.mp4') ?>" type="video/mp4">
                    </video>
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content">
                            <h1 class="hero-title">Logística bajo control,<br>de principio a fin.</h1>
                            <p class="hero-text">Control satelital absoluto de tu mercadería en tiempo real. Seguridad y visibilidad garantizadas en cada tramo de la operación.</p>
                            <div class="hero-buttons">
                                <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                                    Solicitar cotización
                                    <svg class="ms-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="#servicios" class="btn btn-premium-outline">Ver servicios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Flota -->
            <div class="carousel-item h-100">
                <div class="hero-slide-premium" style="background-image: url('<?= asset('images/hero-fleet.jpg') ?>');">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content">
                            <h1 class="hero-title">Flota de última generación.<br>Eficiencia y precisión.</h1>
                            <p class="hero-text">Coordinación inteligente para responder de inmediato. Diseñamos e implementamos la operación exacta que tu carga requiere.</p>
                            <div class="hero-buttons">
                                <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                                    Solicitar cotización
                                    <svg class="ms-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="#servicios" class="btn btn-premium-outline">Ver servicios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Tranquilidad -->
            <div class="carousel-item h-100">
                <div class="hero-slide-premium" style="background-image: url('<?= asset('images/mapa_argentina_red.jpg') ?>');">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content">
                            <h1 class="hero-title">No vendemos transporte.<br>Vendemos <span style="color: #fbbf24;">tranquilidad.</span></h1>
                            <p class="hero-text">Respaldo profesional y atención directa las 24 horas del día. Un equipo dedicado exclusivamente a cuidar tus compromisos comerciales.</p>
                            <div class="hero-buttons">
                                <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                                    Solicitar cotización
                                    <svg class="ms-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="<?= route('empresa') ?>" class="btn btn-premium-outline">Sobre nosotros</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. BANDA DE DIFERENCIALES -->
<section class="diferenciales-strip">
    <div class="container">
        <div class="diferenciales-container">
            <!-- Item 1 -->
            <div class="diferencial-item">
                <div class="diff-icon-circle">
                    <div class="diff-glow-ring"></div>
                    <div class="diff-inner-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="15" width="6" height="3" rx="0.5" transform="rotate(-45 5 16.5)" />
                            <rect x="16" y="6" width="6" height="3" rx="0.5" transform="rotate(-45 19 7.5)" />
                            <rect x="9" y="9" width="6" height="6" rx="1" transform="rotate(-45 12 12)" />
                            <line x1="6.5" y1="14.5" x2="9.5" y2="11.5" />
                            <line x1="14.5" y1="9.5" x2="17.5" y2="6.5" />
                            <path d="M16 16c2 0 4 2 4 4" />
                            <path d="M14 14c4 0 6 2 6 6" />
                        </svg>
                    </div>
                </div>
                <h3 class="diff-title">Seguimiento satelital</h3>
                <div class="diff-yellow-line"></div>
                <p class="diff-desc">GPS en tiempo real</p>
            </div>

            <!-- Item 2 -->
            <div class="diferencial-item">
                <div class="diff-icon-circle">
                    <div class="diff-glow-ring"></div>
                    <div class="diff-inner-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 18H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h8v12zM14 8h5l3 3v5a2 2 0 0 1-2 2h-6V8z"/>
                            <circle cx="7.5" cy="18.5" r="2.5"/>
                            <circle cx="16.5" cy="18.5" r="2.5"/>
                            <line x1="1" y1="9" x2="3" y2="9" />
                            <line x1="0" y1="13" x2="3" y2="13" />
                        </svg>
                    </div>
                </div>
                <h3 class="diff-title">Transporte nacional</h3>
                <div class="diff-yellow-line"></div>
                <p class="diff-desc">Cobertura Federal</p>
            </div>

            <!-- Item 3 -->
            <div class="diferencial-item">
                <div class="diff-icon-circle">
                    <div class="diff-glow-ring"></div>
                    <div class="diff-inner-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                            <rect x="2" y="13" width="3" height="6" rx="1"/>
                            <rect x="19" y="13" width="3" height="6" rx="1"/>
                            <path d="M20 18.5a3 3 0 0 1-3 3h-2"/>
                        </svg>
                    </div>
                </div>
                <h3 class="diff-title">Atención personalizada</h3>
                <div class="diff-yellow-line"></div>
                <p class="diff-desc">Equipo dedicado</p>
            </div>

            <!-- Item 4 -->
            <div class="diferencial-item">
                <div class="diff-icon-circle">
                    <div class="diff-glow-ring"></div>
                    <div class="diff-inner-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="m9 11 2 2 4-4"/>
                        </svg>
                    </div>
                </div>
                <h3 class="diff-title">Operaciones 24/7</h3>
                <div class="diff-yellow-line"></div>
                <p class="diff-desc">Monitoreo continuo</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. SERVICIOS PRINCIPALES -->
<section id="servicios" class="section-dark section-services" data-animate>
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="eyebrow eyebrow-yellow">Nuestras Soluciones</span>
                <h2 class="section-title">Servicios Logísticos Integrales</h2>
                <p class="section-lead text-white-50">Estructuras operativas compactas para adaptarnos al volumen, tipo de mercadería y plazos de tu negocio.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if (!empty($services)): ?>
                <?php foreach (array_slice($services, 0, 6) as $service): ?>
                    <?php 
                        $storageFile = !empty($service['cover_image']) ? __DIR__ . '/../public/storage/' . ltrim($service['cover_image'], '/') : '';
                        $hasStorageImg = $storageFile && file_exists($storageFile);
                        $imgUrl = $hasStorageImg 
                            ? asset('storage/' . ltrim($service['cover_image'], '/')) 
                            : ($imageMap[$service['slug']] ?? asset('images/hero-fleet.jpg'));
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card-compact">
                            <div class="service-img-wrapper">
                                <img src="<?= e($imgUrl) ?>" alt="<?= e($service['title']) ?>" loading="lazy">
                            </div>
                            <div class="service-body">
                                <div>
                                    <h3><?= e($service['title']) ?></h3>
                                    <p><?= e($service['summary'] ?? '') ?></p>
                                </div>
                                <a href="<?= route('servicios.show', ['servicio' => $service['slug']]) ?>" class="service-link">
                                    Ver detalles
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-white-50">
                    <p>No hay servicios disponibles actualmente.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 4. PROCESO LOGÍSTICO CIRCULAR -->
<section id="operaciones" class="section-dark section-operations">
    <div class="operations-bg-grid" aria-hidden="true"></div>

    <div class="container position-relative py-5">
        <div class="text-center mb-5" data-animate>
            <span class="eyebrow-yellow mb-2 d-inline-block">Proceso Logístico</span>
            <h2 class="section-title text-white mb-3">Así gestionamos cada envío</h2>
            <p class="text-white-50 mx-auto max-w-600 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                Desde la solicitud inicial hasta la confirmación de entrega, coordinamos cada etapa con planificación, seguimiento y atención permanente.
            </p>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="ops-view-rendimiento">
                    <div class="logistics-process-desktop d-none d-lg-block">
                        <div class="process-interactive-wrapper">
                            
                            <!-- Left Column: Steps 01, 02, 03 -->
                            <div class="process-side-column side-left">
                                <div class="step-text-block text-start" data-step="1" id="desktop-text-1">
                                    <div class="step-meta">
                                        <span class="step-number-gold">01</span>
                                        <h3 class="step-title-white">Solicitud</h3>
                                    </div>
                                    <p class="step-desc-gray">Recibimos la necesidad del cliente y analizamos origen, destino, volumen y condiciones especiales.</p>
                                    <div class="connector-line-left">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>
                                
                                <div class="step-text-block text-start" data-step="2" id="desktop-text-2">
                                    <div class="step-meta">
                                        <span class="step-number-gold">02</span>
                                        <h3 class="step-title-white">Planificación</h3>
                                    </div>
                                    <p class="step-desc-gray">Diseñamos la ruta, estimamos tiempos y organizamos la operación.</p>
                                    <div class="connector-line-left">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>

                                <div class="step-text-block text-start" data-step="3" id="desktop-text-3">
                                    <div class="step-meta">
                                        <span class="step-number-gold">03</span>
                                        <h3 class="step-title-white">Asignación</h3>
                                    </div>
                                    <p class="step-desc-gray">Seleccionamos el vehículo y el equipo operativo ideal para la carga.</p>
                                    <div class="connector-line-left">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Center: Orbits, Glowing Dot, Circular Buttons and Truck Core -->
                            <div class="process-center-circle-area">
                                <svg class="process-orbits-svg-new" viewBox="0 0 500 500">
                                    <circle cx="250" cy="250" r="220" class="orbit-line-new outer" />
                                    <circle cx="250" cy="250" r="170" class="orbit-line-new middle" />
                                    <circle cx="250" cy="250" r="120" class="orbit-line-new inner" />
                                    <circle cx="250" cy="250" r="7" class="orbit-glowing-dot-new" id="glowing-dot" />
                                </svg>

                                <div class="process-step-btn btn-left-top" data-step="1" id="desktop-step-1">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                                    </div>
                                </div>
                                <div class="process-step-btn btn-left-middle" data-step="2" id="desktop-step-2">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" x2="9" y1="3" y2="18"/><line x1="15" x2="15" y1="6" y2="21"/></svg>
                                    </div>
                                </div>
                                <div class="process-step-btn btn-left-bottom" data-step="3" id="desktop-step-3">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2" ry="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                                    </div>
                                </div>
                                <div class="process-step-btn btn-right-top" data-step="4" id="desktop-step-4">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>
                                    </div>
                                </div>
                                <div class="process-step-btn btn-right-middle" data-step="5" id="desktop-step-5">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                                    </div>
                                </div>
                                <div class="process-step-btn btn-right-bottom" data-step="6" id="desktop-step-6">
                                    <div class="btn-glow-ring"></div>
                                    <div class="btn-inner-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                                    </div>
                                </div>

                                <div class="process-center-core-new">
                                    <div class="center-glow-radial"></div>
                                    <img src="<?= asset('images/logo-nyg.png') ?>" alt="NYG" class="core-brand-logo mb-2">
                                    <div class="core-text-block-new text-center">
                                        <span class="core-txt-white">Operación logística</span>
                                        <span class="core-txt-yellow">bajo control</span>
                                        <span class="core-txt-small mt-2">PLANIFICACIÓN • SEGUIMIENTO • ENTREGA</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Steps 04, 05, 06 -->
                            <div class="process-side-column side-right">
                                <div class="step-text-block text-start" data-step="4" id="desktop-text-4">
                                    <div class="step-meta">
                                        <span class="step-number-gold">04</span>
                                        <h3 class="step-title-white">Seguimiento</h3>
                                    </div>
                                    <p class="step-desc-gray">Monitoreamos el envío mediante GPS durante toda la operación.</p>
                                    <div class="connector-line-right">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>
                                
                                <div class="step-text-block text-start" data-step="5" id="desktop-text-5">
                                    <div class="step-meta">
                                        <span class="step-number-gold">05</span>
                                        <h3 class="step-title-white">Entrega</h3>
                                    </div>
                                    <p class="step-desc-gray">Coordinamos el arribo y verificamos la recepción en destino.</p>
                                    <div class="connector-line-right">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>

                                <div class="step-text-block text-start" data-step="6" id="desktop-text-6">
                                    <div class="step-meta">
                                        <span class="step-number-gold">06</span>
                                        <h3 class="step-title-white">Confirmación</h3>
                                    </div>
                                    <p class="step-desc-gray">Registramos la entrega y generamos la trazabilidad completa.</p>
                                    <div class="connector-line-right">
                                        <div class="line-dot"></div>
                                        <div class="line-stroke"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. CLIENTES -->
<?php if (!empty($clients)): ?>
<section class="section-dark section-clients py-5" data-animate>
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-8">
                <span class="eyebrow eyebrow-yellow" style="font-size: 0.75rem;">Socios Estratégicos</span>
                <h3 class="mb-0 text-white font-weight-normal fs-6 opacity-75">Empresas que confían en nuestra logística</h3>
            </div>
        </div>

        <div class="logo-groups-wrapper">
            <?php 
            $chunks = array_chunk($clients, 6);
            foreach ($chunks as $index => $group): 
            ?>
                <div class="logos-fade-group <?= $index === 0 ? 'active' : '' ?>" id="logo-group-<?= $index + 1 ?>" style="<?= $index > 0 ? 'display: none;' : 'display: flex;' ?>">
                    <?php foreach ($group as $client): ?>
                        <div class="logo-fade-item">
                            <img src="<?= e(client_logo_url($client)) ?>" alt="Logo de <?= e($client['name']) ?>" class="client-fade-logo" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 6. CTA FINAL -->
<section class="section-cta-premium" style="background-image: url('<?= asset('images/camion.png') ?>');" data-animate>
    <div class="container">
        <div class="cta-content-wrapper text-start">
            <span class="eyebrow eyebrow-yellow">Contacto Operativo</span>
            <h2 class="cta-title">¿Listo para tener más control sobre tu logística?</h2>
            <p class="cta-desc">Contanos qué necesitás y armemos una solución adaptada a tu operación.</p>
            
            <div class="cta-buttons">
                <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                    Solicitar cotización
                    <svg class="ms-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                
                <?php
                    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '5491100000000');
                    $whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera solicitar información sobre transporte.');
                ?>
                <a href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener" class="btn-whatsapp-cta">
                    <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.977h.004c4.368 0 7.927-3.558 7.93-7.93a7.9 7.9 0 0 0-2.327-5.615zM7.994 14.52a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.69-4.294c-.198-.099-1.17-.578-1.353-.646-.183-.069-.317-.099-.45.1-.132.197-.512.647-.628.78-.117.13-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.117-.198-.011-.304.088-.403.09-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.251-.015-.35-.052-.099-.45-1.08-.616-1.482-.163-.396-.327-.342-.45-.349-.117-.007-.252-.007-.388-.007a.77.77 0 0 0-.559.258c-.185.205-.705.69-.705 1.685s.722 1.956.823 2.093c.1.137 1.42 2.167 3.437 3.033.48.207.854.33 1.147.424.484.153.924.13 1.272.079.388-.058 1.17-.479 1.334-.941.164-.462.164-.859.115-.941-.05-.082-.18-.131-.379-.23"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
