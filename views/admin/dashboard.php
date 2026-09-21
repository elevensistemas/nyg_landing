<!-- Tarjetas de Métricas de Tráfico y Conversión -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0" style="font-weight: 700;">📊 Tráfico y Conversión (Meta Ads & Web)</h2>
        <a href="<?= route('admin.visits.index') ?>" class="btn btn-sm btn-outline-warning">Ver métricas detalladas &rarr;</a>
    </div>
    <div class="row g-3">
        <div class="col-md-3 col-sm-6">
            <div class="admin-stat-card" style="border-left: 4px solid #3b82f6;">
                <span class="admin-stat-number"><?= number_format($visitStats['today_visits'] ?? 0) ?></span>
                <span class="admin-stat-label">Visitas de Hoy (<?= number_format($visitStats['today_unique_ips'] ?? 0) ?> IPs únicas)</span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="admin-stat-card" style="border-left: 4px solid #10b981;">
                <span class="admin-stat-number"><?= number_format($visitStats['today_forms'] ?? 0) ?></span>
                <span class="admin-stat-label">Formularios enviados Hoy</span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="admin-stat-card" style="border-left: 4px solid #f59e0b;">
                <span class="admin-stat-number"><?= $visitStats['today_conversion_rate'] ?? 0 ?>%</span>
                <span class="admin-stat-label">Conversión Hoy (Visitas ➔ Form)</span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="admin-stat-card" style="border-left: 4px solid #8b5cf6;">
                <span class="admin-stat-number"><?= number_format($visitStats['total_visits'] ?? 0) ?></span>
                <span class="admin-stat-label">Visitas Históricas Registradas</span>
            </div>
        </div>
    </div>
</div>

<!-- Tarjetas de Estado Operativo General -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card">
            <span class="admin-stat-number"><?= $stats['quotes_new'] ?></span>
            <span class="admin-stat-label">Cotizaciones nuevas</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card">
            <span class="admin-stat-number"><?= $stats['quotes_total'] ?></span>
            <span class="admin-stat-label">Cotizaciones totales</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card">
            <span class="admin-stat-number"><?= $stats['contacts_new'] ?></span>
            <span class="admin-stat-label">Consultas nuevas</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="admin-stat-card">
            <span class="admin-stat-number"><?= $stats['services_published'] ?></span>
            <span class="admin-stat-label">Servicios publicados</span>
        </div>
    </div>
</div>

<!-- Tabla de Últimas Visitas en Tiempo Real -->
<div class="card mb-4 bg-dark text-white border-secondary">
    <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-secondary py-3">
        <div class="d-flex align-items-center gap-2">
            <span style="display: inline-block; width: 10px; height: 10px; background: #10b981; border-radius: 50%; animation: pulse 2s infinite;"></span>
            <h2 class="h5 mb-0" style="font-weight: 700;">Últimas Visitas en Tiempo Real</h2>
        </div>
        <a href="<?= route('admin.visits.index') ?>" class="btn btn-sm btn-outline-light">Ver todas</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Hora (Argentina)</th>
                        <th>IP del Visitante</th>
                        <th>Página / Sección que vio</th>
                        <th>Procedencia / Campaña</th>
                        <th>Dispositivo</th>
                        <th>Formulario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($recentVisits)): ?>
                        <?php foreach($recentVisits as $v): ?>
                            <tr>
                                <td>
                                    <strong><?= date('d/m H:i:s', strtotime($v['visited_at'])) ?></strong>
                                </td>
                                <td>
                                    <span style="font-family: monospace; font-size: 0.85rem;"><?= htmlspecialchars($v['ip_address']) ?></span>
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
                                        <small class="d-block text-white-50" style="font-size: 0.7rem;">Campaña: <?= htmlspecialchars($v['utm_campaign']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small><?= htmlspecialchars($v['device_type']) ?> (<?= htmlspecialchars($v['browser']) ?>)</small>
                                </td>
                                <td>
                                    <?php if($v['has_submitted_form']): ?>
                                        <span class="badge bg-success" style="font-size: 0.8rem; padding: 4px 8px;">
                                            ✓ <?= htmlspecialchars($v['form_type'] ?? 'Formulario') ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-dark text-muted border border-secondary" style="font-size: 0.75rem;">
                                            Solo visualización
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= route('admin.visits.show', ['sessionId' => $v['session_id']]) ?>" class="btn btn-sm btn-outline-info" title="Ver todo el recorrido del visitante">Recorrido &rarr;</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-3">Todavía no hay visitas registradas. Navega por el sitio para ver las visitas en vivo.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tablas de Cotizaciones y Consultas -->
<div class="row g-4">
    <div class="col-lg-6">
        <h2 class="h5">Últimas cotizaciones</h2>
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Empresa</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                    <?php if(!empty($latestQuotes)): ?>
                        <?php foreach($latestQuotes as $quote): ?>
                            <tr>
                                <td><?= htmlspecialchars($quote['full_name']) ?></td>
                                <td><?= htmlspecialchars($quote['company'] ?? '—') ?></td>
                                <td><span class="badge-status"><?= htmlspecialchars(\App\Models\QuoteRequest::STATUSES[$quote['status']] ?? $quote['status']) ?></span></td>
                                <td><a href="<?= route('admin.quote-requests.show', ['id' => $quote['id']]) ?>">Ver</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Todavía no hay solicitudes de cotización.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-6">
        <h2 class="h5">Últimas consultas de contacto</h2>
        <div class="table-responsive">
            <table class="table admin-table">
                <thead><tr><th>Nombre</th><th>Correo</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                    <?php if(!empty($latestContacts)): ?>
                        <?php foreach($latestContacts as $contact): ?>
                            <tr>
                                <td><?= htmlspecialchars($contact['name']) ?></td>
                                <td><?= htmlspecialchars($contact['email']) ?></td>
                                <td><span class="badge-status"><?= htmlspecialchars(ucfirst($contact['status'])) ?></span></td>
                                <td><a href="<?= route('admin.contact-requests.show', ['id' => $contact['id']]) ?>">Ver</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Todavía no hay consultas de contacto.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
