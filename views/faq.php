<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Ayuda</p>
        <h1>Preguntas frecuentes</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <?php foreach($faqs as $category => $items): ?>
            <h2 class="mb-3"><?= htmlspecialchars($category) ?></h2>
            <div class="accordion mb-5" id="faq-<?= slugify($category) ?>">
                <?php foreach($items as $faq): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-<?= $faq['id'] ?>" aria-expanded="false" aria-controls="faq-item-<?= $faq['id'] ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h3>
                        <div id="faq-item-<?= $faq['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#faq-<?= slugify($category) ?>">
                            <div class="accordion-body"><?= htmlspecialchars($faq['answer']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <?php
        $schemaItems = [];
        foreach ($faqs as $category => $items) {
            foreach ($items as $faq) {
                $schemaItems[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
                ];
            }
        }
        ?>
        <script type="application/ld+json">
        <?= json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $schemaItems,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
        </script>
    </div>
</section>
