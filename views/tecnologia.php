<div class="tech-page-wrapper">
    <!-- 1. HERO SECTION (Garantizado con tag img y overlay cinematográfico) -->
    <section class="tech-hero-section position-relative">
        <img src="<?= asset('images/tech-hero-bg.jpg') ?>" alt="Tecnología de rastreo satelital NYG Transporte" class="tech-bg-media" fetchpriority="high">
        <div class="tech-bg-overlay" aria-hidden="true"></div>

        <div class="container py-4">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8 col-xl-7">
                    <span class="tech-eyebrow">TECNOLOGÍA</span>
                    <h1 class="tech-hero-title">
                        Cada envío visible.<br>
                        Cada decisión respaldada<span class="tech-dot">.</span>
                    </h1>
                    <p class="tech-hero-lead">
                        Sistemas de trazabilidad en tiempo real, geocercas activas y monitoreo 24/7 para garantizar la entrega de tu mercadería.
                    </p>
                    <div class="tech-hero-actions d-flex flex-wrap gap-3">
                        <a href="#como-funciona" class="btn-tech-outline">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7V17"/>
                            </svg>
                            Conocé cómo funciona
                        </a>
                        <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                            Solicitar cotización
                            <svg class="ms-1" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 4 CARDS FLOTANTES DE GLASSMORPHISM -->
            <div class="row g-3 g-xl-4 tech-cards-row">
                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tech-glass-card">
                        <div class="tech-icon-badge">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                            </svg>
                        </div>
                        <div class="tech-card-content">
                            <h3 class="tech-card-title">Seguimiento satelital</h3>
                            <p class="tech-card-text">Todas las unidades cuentan con sistemas de seguimiento satelital con recupero.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tech-glass-card">
                        <div class="tech-icon-badge">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="tech-card-content">
                            <h3 class="tech-card-title">Visibilidad del envío</h3>
                            <p class="tech-card-text">El cliente puede visualizar el estado de su unidad en tiempo real durante la operación.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tech-glass-card">
                        <div class="tech-icon-badge">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                        </div>
                        <div class="tech-card-content">
                            <h3 class="tech-card-title">Comunicación del estado</h3>
                            <p class="tech-card-text">Mantenemos informado al cliente sobre el estado de su envío en cada etapa del proceso.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tech-glass-card">
                        <div class="tech-icon-badge">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 2v11h3v9l7-12h-4l4-8z"/>
                            </svg>
                        </div>
                        <div class="tech-card-content">
                            <h3 class="tech-card-title">Reacción ante imprevistos</h3>
                            <p class="tech-card-text">El control operativo permite reaccionar rápido ante cualquier eventualidad durante el trayecto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. INFRAESTRUCTURA INTELIGENTE DETALLADA -->
    <section id="como-funciona" class="tech-details-section">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="tech-eyebrow">Infraestructura Inteligente</span>
                    <h2 class="h1 text-white font-weight-bold mb-3">Tecnología aplicada a cada kilómetro</h2>
                    <p class="text-white-50 lead mx-auto" style="max-width: 680px; font-size: 1.05rem;">
                        Nuestra plataforma integra telemetría satelital, análisis de ruta y protocolos preventivos para proteger tu carga de principio a fin.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="tech-feature-box">
                        <div class="mb-3 text-warning">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <h3 class="h5 text-white mb-2">Telemetría Avanzada</h3>
                        <p class="text-white-50 small mb-0">
                            Medición continua de velocidad, paradas, aceleraciones y tiempos de descanso para maximizar la seguridad en ruta.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="tech-feature-box">
                        <div class="mb-3 text-warning">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                        <h3 class="h5 text-white mb-2">Geocercas Dinámicas</h3>
                        <p class="text-white-50 small mb-0">
                            Alertas automáticas ante desvíos de ruta o aperturas de puertas fuera de los puntos autorizados de descarga.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="tech-feature-box">
                        <div class="mb-3 text-warning">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="8" y1="21" x2="16" y2="21"></line>
                                <line x1="12" y1="17" x2="12" y2="21"></line>
                            </svg>
                        </div>
                        <h3 class="h5 text-white mb-2">Monitoreo 24/7</h3>
                        <p class="text-white-50 small mb-0">
                            Torre de control operativa con personal especializado en guardia permanente los 365 días del año.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="tech-feature-box">
                        <div class="mb-3 text-warning">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                        <h3 class="h5 text-white mb-2">Reportes Operativos</h3>
                        <p class="text-white-50 small mb-0">
                            Informes de cumplimiento de tiempos, estadísticas de viaje y confirmación digital inmediata de cada entrega.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. BANNER CTA -->
    <section class="section-cta-premium" style="background-image: url('<?= asset('images/camion.png') ?>');" data-animate>
        <div class="container">
            <div class="cta-content-wrapper text-start">
                <span class="eyebrow eyebrow-yellow">Operaciones Conectadas</span>
                <h2 class="cta-title">¿Querés que tu mercadería viaje con total trazabilidad?</h2>
                <p class="cta-desc">Cotizá tu operación logística hoy mismo y experimentá la tranquilidad de tener el control de punta a punta.</p>
                
                <div class="cta-buttons">
                    <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow">
                        Solicitar cotización
                        <svg class="ms-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    
                    <?php
                        $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '5491100000000');
                        $whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera consultar sobre el servicio de logística con seguimiento satelital.');
                    ?>
                    <a href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener" class="btn-whatsapp-cta">
                        <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.977h.004c4.368 0 7.927-3.558 7.93-7.93a7.9 7.9 0 0 0-2.327-5.615zM7.994 14.52a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.69-4.294c-.198-.099-1.17-.578-1.353-.646-.183-.069-.317-.099-.45.1-.132.197-.512.647-.628.78-.117.13-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.117-.198-.011-.304.088-.403.09-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.251-.015-.35-.052-.099-.45-1.08-.616-1.482-.163-.396-.327-.342-.45-.349-.117-.007-.252-.007-.388-.007a.77.77 0 0 0-.559.258c-.185.205-.705.69-.705 1.685s.722 1.956.823 2.093c.1.137 1.42 2.167 3.437 3.033.48.207.854.33 1.147.424.484.153.924.13 1.272.079.388-.058 1.17-.479 1.334-.941.164-.462.164-.859.115-.941-.05-.082-.18-.131-.379-.23"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
