<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white h4 mb-0">Gestión de Servicios</h2>
    <a href="/admin/services/create" class="btn btn-warning fw-bold">+ Nuevo Servicio</a>
</div>

<div class="table-responsive rounded-4 border border-secondary bg-dark">
    <table class="table table-dark table-hover mb-0 align-middle">
        <thead>
            <tr>
                <th>Título</th>
                <th>Slug</th>
                <th>Estado</th>
                <th>Destacado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td class="fw-bold text-white"><?= e($service['title']) ?></td>
                    <td><code><?= e($service['slug']) ?></code></td>
                    <td>
                        <span class="badge <?= $service['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $service['is_active'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td><?= $service['is_featured'] ? '⭐ Sí' : 'No' ?></td>
                    <td class="text-end">
                        <a href="/admin/services/<?= $service['id'] ?>/edit" class="btn btn-sm btn-outline-warning">Editar</a>
                        <form method="POST" action="/admin/services/<?= $service['id'] ?>" class="d-inline" onsubmit="return confirm('¿Eliminar servicio?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
