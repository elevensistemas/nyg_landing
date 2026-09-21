<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" class="d-flex gap-2">
        <input type="search" name="q" class="form-control" placeholder="Buscar servicio..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button class="btn btn-outline-dark" type="submit">Buscar</button>
    </form>
    <a href="<?= route('admin.services.create') ?>" class="btn btn-cta">Nuevo servicio</a>
</div>

<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Orden</th><th>Nombre</th><th>Categoría</th><th>Destacado</th><th>Publicado</th><th></th></tr></thead>
        <tbody>
            <?php if(!empty($services)): ?>
                <?php foreach($services as $service): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['order']) ?></td>
                        <td><?= htmlspecialchars($service['name']) ?></td>
                        <td><?= htmlspecialchars($service['category_name'] ?? '—') ?></td>
                        <td><?= !empty($service['is_featured_on_home']) ? 'Sí' : 'No' ?></td>
                        <td><?= !empty($service['is_published']) ? 'Sí' : 'No' ?></td>
                        <td class="text-end">
                            <a href="<?= route('admin.services.edit', ['id' => $service['id']]) ?>">Editar</a>
                            <form method="POST" action="<?= route('admin.services.destroy', ['id' => $service['id']]) ?>" class="d-inline" onsubmit="return confirm('¿Eliminar este servicio?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn-link-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No hay servicios cargados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
