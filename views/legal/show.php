<section class="page-hero" data-animate>
    <div class="container text-center py-5">
        <p class="eyebrow text-warning">Legales</p>
        <h1 class="text-white"><?= e($page['title']) ?></h1>
    </div>
</section>

<section class="section-dark py-5" data-animate>
    <div class="container">
        <div class="rich-text text-white-50 p-4 rounded-4 border border-secondary-subtle" style="background-color: #111; line-height: 1.8;">
            <?= $page['content'] ?>
        </div>
    </div>
</section>
