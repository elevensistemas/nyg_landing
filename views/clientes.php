<section class="page-hero" data-animate>
    <div class="container text-center py-5">
        <p class="eyebrow">Clientes</p>
        <h1>Empresas que confiaron en NYG</h1>
    </div>
</section>

<section class="section-dark py-5" data-animate>
    <div class="container">
        <?php if (!empty($clients)): ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($clients as $client): ?>
                    <div class="col-6 col-md-3 col-lg-2 text-center">
                        <div class="p-3 rounded-4 border border-secondary-subtle d-flex align-items-center justify-content-center" style="background-color: #111; height: 100px;">
                            <img src="<?= e($client['logo_url']) ?>" alt="Logo de <?= e($client['name']) ?>" loading="lazy" class="img-fluid" style="max-height: 60px;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-white-50 text-center">Nuestros clientes confían diariamente en nuestras soluciones operativas.</p>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($industries)): ?>
<section class="section-dark py-5 border-top border-secondary-subtle" data-animate>
    <div class="container">
        <h2 class="mb-4 text-white text-center">Sectores atendidos</h2>
        <div class="row g-3 justify-content-center">
            <?php foreach ($industries as $industry): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="p-3 text-center rounded-3 border border-secondary-subtle text-white" style="background-color: #161616;">
                        <?= e($industry['name']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section-accent py-5" data-animate>
    <div class="container text-center">
        <h2>¿Tu empresa necesita una solución logística a medida?</h2>
        <a href="<?= route('cotizacion') ?>" class="btn btn-premium-yellow btn-lg mt-3">Solicitar una propuesta</a>
    </div>
</section>
