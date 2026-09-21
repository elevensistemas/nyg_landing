<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Medidor de Visitas y Conversión de Formularios</h1>
        <p class="text-muted mb-0">Seguimiento en tiempo real con IP, hora oficial de Argentina, páginas vistas y estado de conversión.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= route('admin.visits.index') ?>" class="btn btn-outline-light btn-sm">🔄 Refrescar</a>
    </div>
</div>

<!-- Resumen General de Métricas -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card" style="border-left: 4px solid #3b82f6;">
            <span class="admin-stat-number"><?= number_format($stats['today_visits']) ?></span>
            <span class="admin-stat-label">Visitas de Hoy (<?= number_format($stats['today_unique_ips']) ?> IPs únicas)</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card" style="border-left: 4px solid #10b981;">
            <span class="admin-stat-number"><?= number_format($stats['today_forms']) ?></span>
            <span class="admin-stat-label">Formularios enviados Hoy</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card" style="border-left: 4px solid #f59e0b;">
            <span class="admin-stat-number"><?= $stats['conversion_rate'] ?>%</span>
            <span class="admin-stat-label">Tasa de Conversión Histórica</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card" style="border-left: 4px solid #8b5cf6;">
            <span class="admin-stat-number"><?= number_format($stats['total_visits']) ?></span>
            <span class="admin-stat-label">Total de Páginas Vistas</span>
        </div>
    </div>
</div>

<!-- Widgets de Top Páginas y Top Orígenes de Tráfico -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card bg-dark text-white border-secondary h-100">
            <div class="card-header bg-transparent border-secondary py-3">
                <h2 class="h6 mb-0" style="font-weight: 700;">🔥 Páginas Más Vistas</h2>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr><th>Página</th><th class="text-center">Vistas</th><th class="text-center">Conversiones</th></tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($topPages)): ?>
                            <?php foreach($topPages as $tp): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($tp['page_title']) ?></strong>
                                        <small class="d-block text-white-50" style="font-size: 0.75rem;"><?= htmlspecialchars($tp['page_url']) ?></small>
                                    </td>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $tp['total_views'] ?></span></td>
                                    <td class="text-center">
                                        <?php if($tp['total_conversions'] > 0): ?>
                                            <span class="badge bg-success"><?= $tp['total_conversions'] ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center text-muted">Sin datos aún.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card bg-dark text-white border-secondary h-100">
            <div class="card-header bg-transparent border-secondary py-3">
                <h2 class="h6 mb-0" style="font-weight: 700;">🌐 Fuentes de Tráfico / Campañas</h2>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr><th>Origen</th><th class="text-center">Total Visitas</th></tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($topReferrers)): ?>
                            <?php foreach($topReferrers as $tr): ?>
                                <tr>
                                    <td>
                                        <?php if(str_contains(strtolower($tr['referrer']), 'meta') || str_contains(strtolower($tr['referrer']), 'facebook') || str_contains(strtolower($tr['referrer']), 'instagram')): ?>
                                            <span class="badge bg-primary me-2">Meta Ads</span>
                                        <?php elseif(str_contains(strtolower($tr['referrer']), 'google')): ?>
                                            <span class="badge bg-danger me-2">Google</span>
                                        <?php elseif(str_contains(strtolower($tr['referrer']), 'whatsapp')): ?>
                                            <span class="badge bg-success me-2">WhatsApp</span>
                                        <?php endif; ?>
                                        <span><?= htmlspecialchars($tr['referrer']) ?></span>
                                    </td>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $tr['total'] ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="2" class="text-center text-muted">Sin datos aún.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Barra de Filtros y Búsqueda -->
<div class="card bg-dark text-white border-secondary mb-4">
    <div class="card-body">
        <form method="GET" action="<?= route('admin.visits.index') ?>" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label" style="font-size: 0.85rem;">Buscar por IP, Página o Campaña</label>
                <input type="text" name="search" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Ej: 190.19., Cross-Docking, meta..." value="<?= htmlspecialchars($filters['search']) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label" style="font-size: 0.85rem;">Formulario</label>
                <select name="form" class="form-select form-select-sm bg-dark text-white border-secondary">
                    <option value="all" <?= $filters['form'] === 'all' ? 'selected' : '' ?>>Todos los visitantes</option>
                    <option value="yes" <?= $filters['form'] === 'yes' ? 'selected' : '' ?>>Solo los que llenaron formulario</option>
                    <option value="no" <?= $filters['form'] === 'no' ? 'selected' : '' ?>>Solo los que NO llenaron</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" style="font-size: 0.85rem;">Rango de Fecha</label>
                <select name="date" class="form-select form-select-sm bg-dark text-white border-secondary">
                    <option value="all" <?= $filters['date'] === 'all' ? 'selected' : '' ?>>Todo el historial</option>
                    <option value="today" <?= $filters['date'] === 'today' ? 'selected' : '' ?>>Solo Hoy</option>
                    <option value="yesterday" <?= $filters['date'] === 'yesterday' ? 'selected' : '' ?>>Ayer</option>
                    <option value="7days" <?= $filters['date'] === '7days' ? 'selected' : '' ?>>Últimos 7 días</option>
                    <option value="30days" <?= $filters['date'] === '30days' ? 'selected' : '' ?>>Últimos 30 días</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-primary w-100">Filtrar</button>
                <a href="<?= route('admin.visits.index') ?>" class="btn btn-sm btn-outline-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabla Principal de Registros -->
<div class="card bg-dark text-white border-secondary">
    <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-secondary py-3">
        <h2 class="h5 mb-0" style="font-weight: 700;">Registro Detallado de Visitas</h2>
        <span class="text-white-50" style="font-size: 0.85rem;">Mostrando <?= count($visits['data']) ?> de <?= number_format($visits['total']) ?> registros</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Hora (Argentina)</th>
                        <th>IP del Visitante</th>
                        <th>Página / Sección que vio</th>
                        <th>Procedencia / Referrer</th>
                        <th>Dispositivo / Navegador</th>
                        <th>Formulario Llenado</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($visits['data'])): ?>
                        <?php foreach($visits['data'] as $v): ?>
                            <tr>
                                <td>
                                    <strong><?= date('d/m/Y', strtotime($v['visited_at'])) ?></strong>
                                    <span class="d-block text-warning" style="font-family: monospace; font-size: 0.9rem;"><?= date('H:i:s', strtotime($v['visited_at'])) ?> hs</span>
                                </td>
                                <td>
                                    <span style="font-family: monospace; font-size: 0.85rem; font-weight: 600;"><?= htmlspecialchars($v['ip_address']) ?></span>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #facc15;"><?= htmlspecialchars($v['page_title']) ?></span>
                                    <small class="d-block text-white-50" style="font-size: 0.75rem;"><?= htmlspecialchars($v['page_url']) ?></small>
                                </td>
                                <td>
                                    <?php if(str_contains(strtolower($v['referrer']), 'meta') || str_contains(strtolower($v['referrer']), 'facebook') || str_contains(strtolower($v['referrer']), 'instagram')): ?>
                                        <span class="badge bg-primary" style="font-size: 0.75rem;">Meta Ads / Redes</span>
                                    <?php elseif(str_contains(strtolower($v['referrer']), 'google')): ?>
                                        <span class="badge bg-danger" style="font-size: 0.75rem;">Google</span>
                                    <?php elseif(str_contains(strtolower($v['referrer']), 'whatsapp')): ?>
                                        <span class="badge bg-success" style="font-size: 0.75rem;">WhatsApp</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary" style="font-size: 0.75rem;"><?= htmlspecialchars($v['referrer']) ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty($v['utm_campaign'])): ?>
                                        <small class="d-block text-info" style="font-size: 0.75rem;">Campaña: <?= htmlspecialchars($v['utm_campaign']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small><?= htmlspecialchars($v['device_type']) ?></small>
                                    <small class="d-block text-white-50"><?= htmlspecialchars($v['browser']) ?></small>
                                </td>
                                <td>
                                    <?php if($v['has_submitted_form']): ?>
                                        <span class="badge bg-success" style="font-size: 0.85rem; padding: 5px 10px;">
                                            ✓ <?= htmlspecialchars($v['form_type'] ?? 'Completado') ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-dark text-muted border border-secondary" style="font-size: 0.8rem;">
                                            ✕ No llenó formulario
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= route('admin.visits.show', ['sessionId' => $v['session_id']]) ?>" class="btn btn-sm btn-outline-info">Ver Recorrido &rarr;</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">No se encontraron visitas con los filtros aplicados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Paginación -->
    <?php if($visits['last_page'] > 1): ?>
        <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
            <span class="text-white-50" style="font-size: 0.85rem;">Página <?= $visits['current_page'] ?> de <?= $visits['last_page'] ?></span>
            <div class="d-flex gap-1">
                <?php if($visits['current_page'] > 1): ?>
                    <a href="?page=<?= $visits['current_page'] - 1 ?>&search=<?= urlencode($filters['search']) ?>&form=<?= urlencode($filters['form']) ?>&date=<?= urlencode($filters['date']) ?>" class="btn btn-sm btn-outline-light">&laquo; Anterior</a>
                <?php endif; ?>
                <?php if($visits['current_page'] < $visits['last_page']): ?>
                    <a href="?page=<?= $visits['current_page'] + 1 ?>&search=<?= urlencode($filters['search']) ?>&form=<?= urlencode($filters['form']) ?>&date=<?= urlencode($filters['date']) ?>" class="btn btn-sm btn-outline-light">Siguiente &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
