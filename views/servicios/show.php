<nav aria-label="breadcrumb" class="container pt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= route('home') ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?= route('servicios.index') ?>">Servicios</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= e($service['title']) ?></li>
    </ol>
</nav>

<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Servicio</p>
        <h1><?= e($service['title']) ?></h1>
        <?php if (!empty($service['summary'])): ?>
            <p class="lead-text"><?= e($service['summary']) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section-light py-5" data-animate>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8 text-start">
                <h2 class="text-white mb-3">Descripción del servicio</h2>
                <div class="rich-text text-white-50" style="line-height: 1.8;">
                    <?php foreach (explode("\n", $service['description'] ?? '') as $paragraph): ?>
                        <?php if (trim($paragraph) !== ''): ?>
                            <p><?= e($paragraph) ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cta-box p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                    <h3 class="text-white h5 mb-3">¿Te interesa este servicio?</h3>
                    <p class="text-white-50 small mb-4">Contanos los detalles de tu operación y te respondemos a la brevedad.</p>
                    <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow w-100 mb-2">Solicitar cotización</a>
                    <a href="<?= route('faq') ?>" class="btn btn-premium-outline w-100">Ver preguntas frecuentes</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($allServices)): ?>
<section class="section-light py-5" data-animate>
    <div class="container">
        <h2 class="mb-4 text-white">Servicios relacionados</h2>
        <div class="row g-4">
            <?php foreach (array_slice($allServices, 0, 3) as $relatedService): ?>
                <?php if ($relatedService['id'] == $service['id']) continue; ?>
                <div class="col-md-4">
                    <article class="service-card p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                        <h3 class="h5 text-white mb-2"><a href="<?= route('servicios.show', ['servicio' => $relatedService['slug']]) ?>" class="text-white text-decoration-none"><?= e($relatedService['title']) ?></a></h3>
                        <p class="text-white-50 small mb-0"><?= e($relatedService['summary'] ?? '') ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
