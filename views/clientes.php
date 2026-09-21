<?php
use App\Models\Client;
?>
<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Clientes</p>
        <h1>Empresas que confiaron en NYG</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <?php if(!empty($clients)): ?>
            <div class="clients-grid">
                <?php foreach($clients as $client): ?>
                    <div class="clients-grid-item" title="<?= htmlspecialchars($client['name']) ?>">
                        <img src="<?= htmlspecialchars(Client::getLogoUrl($client['logo_path'])) ?>" alt="Logo de <?= htmlspecialchars($client['name']) ?>" loading="lazy" width="160" height="80">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Los logotipos de clientes se están cargando desde el panel administrativo.</p>
        <?php endif; ?>
    </div>
</section>

<?php if(!empty($industries)): ?>
<section class="section-light" data-animate>
    <div class="container">
        <h2 class="mb-4">Sectores atendidos</h2>
        <div class="row g-3">
            <?php foreach($industries as $industry): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="industry-chip"><?= htmlspecialchars($industry['name']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section-accent" data-animate>
    <div class="container text-center">
        <h2>¿Tu empresa necesita una solución logística a medida?</h2>
        <a href="<?= route('cotizacion') ?>" class="btn btn-cta btn-lg mt-3">Solicitar una propuesta</a>
    </div>
</section>
