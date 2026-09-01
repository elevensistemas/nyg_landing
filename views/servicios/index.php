<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Servicios</p>
        <h1>Soluciones logísticas para cada operación</h1>
        <p class="lead-text">
            Cada servicio está pensado para resolver un problema concreto de transporte, almacenamiento o distribución.
        </p>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row g-4">
            <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="service-card p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                        <h3 class="h4 text-white mb-2"><a href="<?= route('servicios.show', ['servicio' => $service['slug']]) ?>" class="text-white text-decoration-none"><?= e($service['title']) ?></a></h3>
                        <p class="text-white-50 small"><?= e($service['summary'] ?? '') ?></p>
                        <a href="<?= route('servicios.show', ['servicio' => $service['slug']]) ?>" class="btn btn-sm btn-outline-warning mt-2">Ver detalle &rarr;</a>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-accent py-5" data-animate>
    <div class="container text-center">
        <h2>¿No encontrás el servicio que necesitás?</h2>
        <p class="lead-text">Contanos tu operación y te ayudamos a definir la solución adecuada.</p>
        <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow btn-lg mt-3">Solicitar cotización</a>
    </div>
</section>
