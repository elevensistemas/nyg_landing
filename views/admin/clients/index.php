<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="mb-0">Solo se publican los clientes ya confirmados por NYG. No agregar clientes nuevos sin autorización.</p>
    <a href="<?= route('admin.clients.create') ?>" class="btn btn-cta">Nuevo cliente</a>
</div>

<div class="clients-admin-grid">
    <?php if(!empty($clients)): ?>
        <?php foreach($clients as $client): ?>
            <div class="clients-admin-item">
                <img src="<?= htmlspecialchars(\App\Models\Client::getLogoUrl($client['logo_path'])) ?>" alt="<?= htmlspecialchars($client['name']) ?>" onerror="this.style.opacity=0.2">
                <p><?= htmlspecialchars($client['name']) ?></p>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="<?= route('admin.clients.edit', ['id' => $client['id']]) ?>">Editar</a>
                    <form method="POST" action="<?= route('admin.clients.destroy', ['id' => $client['id']]) ?>" onsubmit="return confirm('¿Eliminar este cliente?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-link-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay clientes cargados.</p>
    <?php endif; ?>
</div>
