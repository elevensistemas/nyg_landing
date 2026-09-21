<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Fecha</th><th>Nombre</th><th>Correo</th><th>Estado</th><th></th></tr></thead>
        <tbody>
            <?php if(!empty($contacts)): ?>
                <?php foreach($contacts as $contact): ?>
                    <tr class="<?= !empty($contact['read_at']) ? '' : 'fw-bold' ?>">
                        <td><?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?></td>
                        <td><?= htmlspecialchars($contact['name']) ?></td>
                        <td><?= htmlspecialchars($contact['email']) ?></td>
                        <td><span class="badge-status"><?= htmlspecialchars(ucfirst($contact['status'])) ?></span></td>
                        <td><a href="<?= route('admin.contact-requests.show', ['id' => $contact['id']]) ?>">Ver</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay consultas de contacto.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
