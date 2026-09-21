<div class="row">
    <div class="col-lg-5">
        <h2 class="h6">Nueva categoría</h2>
        <form method="POST" action="<?= route('admin.service-categories.store') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Orden</label>
                <input type="number" name="order" class="form-control" value="0">
            </div>
            <button type="submit" class="btn btn-cta">Crear</button>
        </form>
    </div>

    <div class="col-lg-7">
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Publicado</th><th></th></tr></thead>
                <tbody>
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $category): ?>
                            <tr>
                                <form method="POST" action="<?= route('admin.service-categories.update', ['id' => $category['id']]) ?>">
                                    <?= csrf_field() ?>
                                    <td><input type="text" name="name" class="form-control form-control-sm" value="<?= htmlspecialchars($category['name']) ?>"></td>
                                    <td>
                                        <input type="checkbox" name="is_published" value="1" <?= !empty($category['is_published']) ? 'checked' : '' ?>>
                                    </td>
                                    <td class="text-end">
                                        <button type="submit" class="btn btn-sm btn-outline-dark">Guardar</button>
                                    </td>
                                </form>
                                <td>
                                    <form method="POST" action="<?= route('admin.service-categories.destroy', ['id' => $category['id']]) ?>" onsubmit="return confirm('¿Eliminar esta categoría?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn-link-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3">No hay categorías cargadas.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
