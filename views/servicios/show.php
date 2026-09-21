<nav aria-label="breadcrumb" class="container pt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= route('home') ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?= route('servicios.index') ?>">Servicios</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($service['name']) ?></li>
    </ol>
</nav>

<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Servicio</p>
        <h1><?= htmlspecialchars($service['name']) ?></h1>
        <?php if($service['problem']): ?>
            <p class="lead-text"><?= htmlspecialchars($service['problem']) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2>Descripción del servicio</h2>
                <div class="rich-text">
                    <?php foreach(explode("\n", $service['description']) as $paragraph): ?>
                        <?php if(trim($paragraph) !== ''): ?>
                            <p><?= htmlspecialchars($paragraph) ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <?php if($service['benefits']): ?>
                    <h2 class="mt-4">Beneficios</h2>
                    <ul class="benefits-list">
                        <?php foreach(explode("\n", $service['benefits']) as $benefit): ?>
                            <?php if(trim($benefit) !== ''): ?>
                                <li><?= htmlspecialchars($benefit) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="cta-box">
                    <h3>¿Te interesa este servicio?</h3>
                    <p>Contanos los detalles de tu operación y te respondemos a la brevedad.</p>
                    <a href="<?= route('cotizacion', ['servicio' => $service['slug']]) ?>" class="btn btn-premium-yellow w-100 mb-2">Solicitar cotización</a>
                    <a href="<?= route('faq') ?>" class="btn btn-premium-outline w-100">Ver preguntas frecuentes</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(!empty($related)): ?>
<section class="section-light" data-animate>
    <div class="container">
        <h2 class="mb-4">Servicios relacionados</h2>
        <div class="row g-4">
            <?php foreach($related as $relatedService): ?>
                <div class="col-md-4">
                    <article class="service-card">
                        <h3><a href="<?= route('servicios.show', ['servicio' => $relatedService['slug']]) ?>"><?= htmlspecialchars($relatedService['name']) ?></a></h3>
                        <p><?= htmlspecialchars($relatedService['short_description']) ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
