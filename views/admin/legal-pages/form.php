<form method="POST" action="<?= route('admin.legal-pages.update', ['id' => $page['id']]) ?>">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($page['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contenido (HTML permitido)</label>
        <textarea name="content" class="form-control" rows="16"><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" <?= !empty($page['is_published']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="published">Publicada</label>
    </div>

    <button type="submit" class="btn btn-cta">Guardar</button>
    <a href="<?= route('admin.legal-pages.index') ?>" class="btn btn-outline-dark">Cancelar</a>
</form>
