<form method="GET" class="d-flex gap-2 mb-3">
    <input type="search" name="q" class="form-control" placeholder="Buscar por nombre, empresa o correo..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <select name="status" class="form-select" style="max-width:220px;">
        <option value="">Todos los estados</option>
        <?php foreach($statuses as $key => $label): ?>
            <option value="<?= htmlspecialchars($key) ?>" <?= ($_GET['status'] ?? '') === $key ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-outline-dark" type="submit">Filtrar</button>
</form>

<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Fecha</th><th>Nombre</th><th>Empresa</th><th>Servicio</th><th>Estado</th><th></th></tr></thead>
        <tbody>
            <?php if(!empty($quotes)): ?>
                <?php foreach($quotes as $quote): ?>
                    <tr class="<?= !empty($quote['read_at']) ? '' : 'fw-bold' ?>">
                        <td><?= date('d/m/Y H:i', strtotime($quote['created_at'])) ?></td>
                        <td><?= htmlspecialchars($quote['full_name']) ?></td>
                        <td><?= htmlspecialchars($quote['company'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($quote['service_name'] ?? $quote['service_type_other'] ?? '—') ?></td>
                        <td><span class="badge-status"><?= htmlspecialchars($statuses[$quote['status']] ?? $quote['status']) ?></span></td>
                        <td><a href="<?= route('admin.quote-requests.show', ['id' => $quote['id']]) ?>">Ver</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No hay solicitudes de cotización.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
