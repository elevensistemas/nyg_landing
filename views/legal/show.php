<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Legales</p>
        <h1><?= htmlspecialchars($page['title']) ?></h1>
        <?php if(!empty($page['last_reviewed_at'])): ?>
            <p class="text-muted small">Última revisión: <?= date('d/m/Y', strtotime($page['last_reviewed_at'])) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="rich-text legal-content">
            <?= $page['content'] ?>
        </div>
    </div>
</section>
