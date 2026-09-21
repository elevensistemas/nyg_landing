<?php
$isEdit = !empty($client['id']);
$old = $_SESSION['_old'] ?? [];
unset($_SESSION['_old']);

function oldVal($key, $default) {
    global $old;
    return isset($old[$key]) ? $old[$key] : $default;
}
?>

<form method="POST" action="<?= $isEdit ? route('admin.clients.update', ['id' => $client['id']]) : route('admin.clients.store') ?>" enctype="multipart/form-data" class="col-lg-6">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Nombre *</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars(oldVal('name', $client['name'])) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Sitio web</label>
        <input type="url" name="website_url" class="form-control" value="<?= htmlspecialchars(oldVal('website_url', $client['website_url'])) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Logotipo <?= $isEdit ? '' : '*' ?></label>
        <input type="file" name="logo" class="form-control" <?= $isEdit ? '' : 'required' ?>>
        <?php if($isEdit): ?>
            <img src="<?= htmlspecialchars(\App\Models\Client::getLogoUrl($client['logo_path'])) ?>" alt="<?= htmlspecialchars($client['name']) ?>" style="height:48px;margin-top:8px;">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Orden</label>
        <input type="number" name="order" class="form-control" value="<?= htmlspecialchars(oldVal('order', $client['order'] ?? 0)) ?>">
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="published" <?= oldVal('is_published', $isEdit ? $client['is_published'] : true) ? 'checked' : '' ?>>
        <label class="form-check-label" for="published">Publicado</label>
    </div>

    <button type="submit" class="btn btn-cta">Guardar</button>
    <a href="<?= route('admin.clients.index') ?>" class="btn btn-outline-dark">Cancelar</a>
</form>
