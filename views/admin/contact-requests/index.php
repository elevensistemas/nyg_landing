<div class="h4 text-white mb-4">Mensajes de Contacto</div>

<div class="table-responsive rounded-4 border border-secondary bg-dark text-start">
    <table class="table table-dark table-hover mb-0 align-middle">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th class="text-end">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactRequests as $c): ?>
                <tr>
                    <td class="fw-bold text-white"><?= e($c['name']) ?></td>
                    <td><a href="mailto:<?= e($c['email']) ?>" class="text-warning"><?= e($c['email']) ?></a></td>
                    <td><?= e($c['phone'] ?: 'N/A') ?></td>
                    <td><span class="badge bg-info text-dark"><?= e($c['status']) ?></span></td>
                    <td class="small text-white-50"><?= e($c['created_at']) ?></td>
                    <td class="text-end">
                        <a href="/admin/contact-requests/<?= $c['id'] ?>" class="btn btn-sm btn-warning fw-bold">Ver detalle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
