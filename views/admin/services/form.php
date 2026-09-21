<?php
$isEdit = !empty($service['id']);
$old = $_SESSION['_old'] ?? [];
unset($_SESSION['_old']);

function oldVal($key, $default) {
    global $old;
    return isset($old[$key]) ? $old[$key] : $default;
}
?>

<form method="POST" action="<?= $isEdit ? route('admin.services.update', ['id' => $service['id']]) : route('admin.services.store') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars(oldVal('name', $service['name'])) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Slug (dejar vacío para autogenerar)</label>
                <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars(oldVal('slug', $service['slug'])) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Problema que resuelve</label>
                <input type="text" name="problem" class="form-control" value="<?= htmlspecialchars(oldVal('problem', $service['problem'])) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción corta (para tarjetas) *</label>
                <textarea name="short_description" class="form-control" rows="2" required><?= htmlspecialchars(oldVal('short_description', $service['short_description'])) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción completa *</label>
                <textarea name="description" class="form-control" rows="6" required><?= htmlspecialchars(oldVal('description', $service['description'])) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Beneficios (uno por línea)</label>
                <textarea name="benefits" class="form-control" rows="4"><?= htmlspecialchars(oldVal('benefits', $service['benefits'])) ?></textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="service_category_id" class="form-select">
                    <option value="">Sin categoría</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= oldVal('service_category_id', $service['service_category_id']) == $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ícono (nombre lineal)</label>
                <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars(oldVal('icon', $service['icon'])) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen de portada</label>
                <input type="file" name="cover_image" class="form-control">
                <?php if(!empty($service['cover_image'])): ?>
                    <div class="form-text">Actual: <?= htmlspecialchars($service['cover_image']) ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Orden</label>
                <input type="number" name="order" class="form-control" value="<?= htmlspecialchars(oldVal('order', $service['order'] ?? 0)) ?>">
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="is_featured_on_home" value="1" id="featured" <?= oldVal('is_featured_on_home', $service['is_featured_on_home']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="featured">Destacado en Inicio</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" <?= oldVal('is_published', $isEdit ? $service['is_published'] : true) ? 'checked' : '' ?>>
                <label class="form-check-label" for="published">Publicado</label>
            </div>

            <button type="submit" class="btn btn-cta w-100">Guardar</button>
            <a href="<?= route('admin.services.index') ?>" class="btn btn-outline-dark w-100 mt-2">Cancelar</a>
        </div>
    </div>
</form>
