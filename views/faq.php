<section class="page-hero" data-animate>
    <div class="container text-center py-5">
        <p class="eyebrow">Ayuda</p>
        <h1>Preguntas frecuentes</h1>
    </div>
</section>

<section class="section-dark py-5" data-animate>
    <div class="container">
        <?php if (!empty($faqs)): ?>
            <div class="accordion" id="faqAccordion">
                <?php foreach ($faqs as $i => $faq): ?>
                    <div class="accordion-item bg-dark border border-secondary-subtle mb-3 rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button bg-dark text-white <?= $i === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-<?= $faq['id'] ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq-item-<?= $faq['id'] ?>">
                                <?= e($faq['question']) ?>
                            </button>
                        </h3>
                        <div id="faq-item-<?= $faq['id'] ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50"><?= e($faq['answer']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-white-50 text-center">No hay preguntas frecuentes cargadas en este momento.</p>
        <?php endif; ?>
    </div>
</section>
