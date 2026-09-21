<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-detail-card">
            <h2 class="h5">Datos de contacto</h2>
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['full_name']) ?></dd>
                <dt class="col-sm-3">Empresa</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['company'] ?? '—') ?></dd>
                <dt class="col-sm-3">Correo</dt><dd class="col-sm-9"><a href="mailto:<?= htmlspecialchars($quote['email']) ?>"><?= htmlspecialchars($quote['email']) ?></a></dd>
                <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['phone']) ?></dd>
            </dl>

            <h2 class="h5">Detalle de la operación</h2>
            <dl class="row">
                <dt class="col-sm-3">Servicio</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['service_name'] ?? $quote['service_type_other'] ?? '—') ?></dd>
                <dt class="col-sm-3">Origen</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['origin'] ?? '—') ?></dd>
                <dt class="col-sm-3">Destino</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['destination'] ?? '—') ?></dd>
                <dt class="col-sm-3">Mercadería</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['cargo_type'] ?? '—') ?></dd>
                <dt class="col-sm-3">Temperatura</dt><dd class="col-sm-9"><?= !empty($quote['requires_temperature_control']) ? htmlspecialchars($quote['temperature_requirement'] ?? 'Sí') : 'No' ?></dd>
                <dt class="col-sm-3">Peso aprox.</dt><dd class="col-sm-9"><?= !empty($quote['approx_weight_kg']) ? htmlspecialchars($quote['approx_weight_kg']) . ' kg' : '—' ?></dd>
                <dt class="col-sm-3">Volumen aprox.</dt><dd class="col-sm-9"><?= !empty($quote['approx_volume_m3']) ? htmlspecialchars($quote['approx_volume_m3']) . ' m³' : '—' ?></dd>
                <dt class="col-sm-3">Pallets/bultos</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['pallets_or_packages'] ?? '—') ?></dd>
                <dt class="col-sm-3">Frecuencia</dt><dd class="col-sm-9"><?= htmlspecialchars($quote['frequency'] ?? '—') ?></dd>
                <dt class="col-sm-3">Fecha estimada</dt><dd class="col-sm-9"><?= !empty($quote['estimated_date']) ? date('d/m/Y', strtotime($quote['estimated_date'])) : '—' ?></dd>
            </dl>

            <?php if(!empty($quote['comments'])): ?>
                <h2 class="h5">Comentarios</h2>
                <p><?= nl2br(htmlspecialchars($quote['comments'])) ?></p>
            <?php endif; ?>

            <?php if(!empty($attachments)): ?>
                <h2 class="h5">Adjuntos</h2>
                <ul>
                    <?php foreach($attachments as $attachment): ?>
                        <li><a href="<?= asset('storage/' . $attachment['path']) ?>" target="_blank"><?= htmlspecialchars($attachment['original_name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-detail-card">
            <h2 class="h5">Gestión de la oportunidad</h2>
            <form method="POST" action="<?= route('admin.quote-requests.update', ['id' => $quote['id']]) ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <?php foreach($statuses as $key => $label): ?>
                            <option value="<?= htmlspecialchars($key) ?>" <?= $quote['status'] === $key ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notas internas</label>
                    <textarea name="internal_notes" class="form-control" rows="4"><?= htmlspecialchars($quote['internal_notes'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-cta w-100">Guardar</button>
            </form>

            <form method="POST" action="<?= route('admin.quote-requests.destroy', ['id' => $quote['id']]) ?>" class="mt-2" onsubmit="return confirm('¿Eliminar esta solicitud?');">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-danger w-100">Eliminar solicitud</button>
            </form>
        </div>
    </div>
</div>
