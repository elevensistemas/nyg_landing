<div class="row">
    <div class="col-lg-5">
        <h2 class="h6">Nueva pregunta</h2>
        <form method="POST" action="<?= route('admin.faqs.store') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Pregunta</label>
                <input type="text" name="question" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Respuesta</label>
                <textarea name="answer" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input type="text" name="category" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Orden</label>
                <input type="number" name="order" class="form-control" value="0">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="new_faq_published" checked>
                <label class="form-check-label" for="new_faq_published">Publicada</label>
            </div>
            <button type="submit" class="btn btn-cta">Crear</button>
        </form>
    </div>

    <div class="col-lg-7">
        <?php if(!empty($faqs)): ?>
            <?php foreach($faqs as $faq): ?>
                <div class="admin-faq-item mb-3">
                    <form method="POST" action="<?= route('admin.faqs.update', ['id' => $faq['id']]) ?>">
                        <?= csrf_field() ?>
                        <input type="text" name="question" class="form-control mb-2" value="<?= htmlspecialchars($faq['question']) ?>">
                        <textarea name="answer" class="form-control mb-2" rows="2"><?= htmlspecialchars($faq['answer']) ?></textarea>
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" name="category" class="form-control form-control-sm" value="<?= htmlspecialchars($faq['category'] ?? '') ?>" style="max-width:200px;">
                            <label><input type="checkbox" name="is_published" value="1" <?= !empty($faq['is_published']) ? 'checked' : '' ?>> Publicada</label>
                            <button type="submit" class="btn btn-sm btn-outline-dark">Guardar</button>
                        </div>
                    </form>
                    <form method="POST" action="<?= route('admin.faqs.destroy', ['id' => $faq['id']]) ?>" onsubmit="return confirm('¿Eliminar esta pregunta?');" class="mt-1">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-link-danger">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay preguntas cargadas.</p>
        <?php endif; ?>
    </div>
</div>
