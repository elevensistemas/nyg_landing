<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="<?= route('admin.visits.index') ?>" class="text-muted text-decoration-none">&larr; Volver al listado de visitas</a>
        <h1 class="h3 mt-2 mb-1">Recorrido del Visitante</h1>
        <p class="text-muted mb-0">Secuencia cronológica de páginas y acciones realizadas durante la sesión.</p>
    </div>
</div>

<!-- Ficha de Datos del Visitante -->
<div class="card bg-dark text-white border-secondary mb-4">
    <div class="card-header bg-transparent border-secondary py-3">
        <h2 class="h5 mb-0" style="font-weight: 700;">👤 Datos Técnicos del Visitante</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <small class="text-white-50 d-block">Dirección IP</small>
                <strong style="font-family: monospace; font-size: 1rem; color: #facc15;"><?= htmlspecialchars($visitorIp) ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-white-50 d-block">Dispositivo / Navegador</small>
                <strong><?= htmlspecialchars($visitorDevice) ?> (<?= htmlspecialchars($visitorBrowser) ?>)</strong>
            </div>
            <div class="col-md-3">
                <small class="text-white-50 d-block">Procedencia / Referrer</small>
                <strong><?= htmlspecialchars($visitorReferrer) ?></strong>
            </div>
            <div class="col-md-3">
                <small class="text-white-50 d-block">Total de Páginas Vistas en Sesión</small>
                <strong class="badge bg-primary fs-6"><?= count($sessionVisits) ?> páginas</strong>
            </div>
        </div>
    </div>
</div>

<!-- Línea de Tiempo del Recorrido -->
<div class="card bg-dark text-white border-secondary">
    <div class="card-header bg-transparent border-secondary py-3">
        <h2 class="h5 mb-0" style="font-weight: 700;">⏱ Línea de Tiempo de Navegación (Hora Argentina)</h2>
    </div>
    <div class="card-body">
        <div class="timeline" style="border-left: 2px solid #3b82f6; margin-left: 10px; padding-left: 20px;">
            <?php foreach($sessionVisits as $index => $step): ?>
                <div class="mb-4 position-relative">
                    <span style="position: absolute; left: -26px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: <?= $step['has_submitted_form'] ? '#10b981' : '#3b82f6' ?>; border: 2px solid #fff;"></span>
                    
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge bg-secondary">Paso <?= $index + 1 ?></span>
                        <span class="text-warning" style="font-family: monospace; font-size: 0.85rem;">
                            <?= date('d/m/Y H:i:s', strtotime($step['visited_at'])) ?> hs (Arg)
                        </span>
                    </div>

                    <div class="p-3 bg-secondary bg-opacity-10 rounded border border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="h6 mb-1 text-warning"><?= htmlspecialchars($step['page_title']) ?></h4>
                                <small class="text-white-50 font-monospace"><?= htmlspecialchars($step['page_url']) ?></small>
                            </div>
                            <?php if($step['has_submitted_form']): ?>
                                <div>
                                    <span class="badge bg-success py-2 px-3">
                                        ✓ ¡Envió <?= htmlspecialchars($step['form_type'] ?? 'Formulario') ?>!
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
