<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-detail-card">
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9"><?= htmlspecialchars($contact['name']) ?></dd>
                <dt class="col-sm-3">Correo</dt><dd class="col-sm-9"><a href="mailto:<?= htmlspecialchars($contact['email']) ?>"><?= htmlspecialchars($contact['email']) ?></a></dd>
                <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9"><?= htmlspecialchars($contact['phone'] ?? '—') ?></dd>
            </dl>
            <h2 class="h5">Mensaje</h2>
            <p><?= nl2br(htmlspecialchars($contact['message'])) ?></p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-detail-card">
            <form method="POST" action="<?= route('admin.contact-requests.update', ['id' => $contact['id']]) ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="nuevo" <?= ($contact['status'] === 'nuevo' || $contact['status'] === 'nueva') ? 'selected' : '' ?>>Nuevo</option>
                        <option value="leido" <?= $contact['status'] === 'leido' ? 'selected' : '' ?>>Leído</option>
                        <option value="respondido" <?= $contact['status'] === 'respondido' ? 'selected' : '' ?>>Respondido</option>
                        <option value="descartado" <?= $contact['status'] === 'descartado' ? 'selected' : '' ?>>Descartado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-cta w-100">Guardar</button>
            </form>
            <form method="POST" action="<?= route('admin.contact-requests.destroy', ['id' => $contact['id']]) ?>" class="mt-2" onsubmit="return confirm('¿Eliminar esta consulta?');">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-danger w-100">Eliminar</button>
            </form>
        </div>
    </div>
</div>
