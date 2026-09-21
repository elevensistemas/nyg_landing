<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Servicios</p>
        <h1>Soluciones logísticas para cada operación</h1>
        <p class="lead-text">
            Cada servicio está pensado para resolver un problema concreto de transporte, almacenamiento o distribución.
        </p>
    </div>
</section>

<?php foreach($categories as $category): ?>
    <?php if(!empty($category['services'])): ?>
        <section class="section-light" data-animate>
            <div class="container">
                <h2 class="mb-4"><?= htmlspecialchars($category['name']) ?></h2>
                <div class="row g-4">
                    <?php foreach($category['services'] as $service): ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="service-card">
                                <h3><a href="<?= route('servicios.show', ['servicio' => $service['slug']]) ?>"><?= htmlspecialchars($service['name']) ?></a></h3>
                                <p><?= htmlspecialchars($service['short_description']) ?></p>
                                <a href="<?= route('servicios.show', ['servicio' => $service['slug']]) ?>" class="service-card-link">Ver detalle &rarr;</a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>

<section class="section-accent" data-animate>
    <div class="container text-center">
        <h2>¿No encontrás el servicio que necesitás?</h2>
        <p class="lead-text">Contanos tu operación y te ayudamos a definir la solución adecuada.</p>
        <a href="<?= route('cotizacion') ?>" class="btn btn-cta btn-lg mt-3">Solicitar cotización</a>
    </div>
</section>
