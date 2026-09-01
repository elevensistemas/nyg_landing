<div class="h4 text-white mb-4">Solicitudes de Cotización</div>

<div class="table-responsive rounded-4 border border-secondary bg-dark text-start">
    <table class="table table-dark table-hover mb-0 align-middle">
        <thead>
            <tr>
                <th>Empresa / Contacto</th>
                <th>Trayecto</th>
                <th>Tipo de Carga</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th class="text-end">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quoteRequests as $q): ?>
                <tr>
                    <td>
                        <strong class="text-white d-block"><?= e($q['company_name']) ?></strong>
                        <small class="text-white-50"><?= e($q['contact_name']) ?> (<?= e($q['phone']) ?>)</small>
                    </td>
                    <td><?= e($q['origin_city']) ?> &rarr; <?= e($q['destination_city']) ?></td>
                    <td><?= e($q['cargo_type']) ?></td>
                    <td><span class="badge bg-warning text-dark"><?= e($q['status']) ?></span></td>
                    <td class="small text-white-50"><?= e($q['created_at']) ?></td>
                    <td class="text-end">
                        <a href="/admin/quote-requests/<?= $q['id'] ?>" class="btn btn-sm btn-warning fw-bold">Ver detalle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
