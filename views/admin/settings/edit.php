<form method="POST" action="<?= route('admin.settings.update') ?>">
    <?= csrf_field() ?>

    <?php foreach($settings as $group => $items): ?>
        <h2 class="h5 text-capitalize"><?= htmlspecialchars($group) ?></h2>
        <div class="row mb-4">
            <?php foreach($items as $setting): ?>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?= htmlspecialchars($setting['label'] ?? $setting['key']) ?></label>
                    <?php if($setting['type'] === 'textarea'): ?>
                        <textarea name="settings[<?= htmlspecialchars($setting['key']) ?>]" class="form-control" rows="3"><?= htmlspecialchars($setting['value'] ?? '') ?></textarea>
                    <?php else: ?>
                        <input type="text" name="settings[<?= htmlspecialchars($setting['key']) ?>]" class="form-control" value="<?= htmlspecialchars($setting['value'] ?? '') ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-cta">Guardar configuración</button>
</form>
