<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <span class="text-white-50 small d-block mb-1">Cotizaciones Recibidas</span>
            <h2 class="display-6 text-warning mb-0"><?= $quoteRequestsCount ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <span class="text-white-50 small d-block mb-1">Mensajes de Contacto</span>
            <h2 class="display-6 text-warning mb-0"><?= $contactRequestsCount ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <span class="text-white-50 small d-block mb-1">Servicios Activos</span>
            <h2 class="display-6 text-warning mb-0"><?= $servicesCount ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <span class="text-white-50 small d-block mb-1">Clientes Destacados</span>
            <h2 class="display-6 text-warning mb-0"><?= $clientsCount ?></h2>
        </div>
    </div>
</div>

<div class="row g-4 text-start">
    <div class="col-md-6">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5 mb-0 text-white">Últimas Cotizaciones</h3>
                <a href="/admin/quote-requests" class="btn btn-sm btn-outline-warning">Ver todas</a>
            </div>
            <?php if (!empty($latestQuotes)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($latestQuotes as $quote): ?>
                        <a href="/admin/quote-requests/<?= $quote['id'] ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary">
                            <div class="d-flex justify-content-between">
                                <strong><?= e($quote['company_name']) ?> (<?= e($quote['contact_name']) ?>)</strong>
                                <span class="badge bg-secondary"><?= e($quote['status']) ?></span>
                            </div>
                            <small class="text-white-50"><?= e($quote['origin_city']) ?> &rarr; <?= e($quote['destination_city']) ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-white-50 small">No hay solicitudes de cotización recientes.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5 mb-0 text-white">Últimos Mensajes de Contacto</h3>
                <a href="/admin/contact-requests" class="btn btn-sm btn-outline-warning">Ver todos</a>
            </div>
            <?php if (!empty($latestContacts)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($latestContacts as $contact): ?>
                        <a href="/admin/contact-requests/<?= $contact['id'] ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary">
                            <div class="d-flex justify-content-between">
                                <strong><?= e($contact['name']) ?></strong>
                                <span class="badge bg-secondary"><?= e($contact['status']) ?></span>
                            </div>
                            <small class="text-white-50"><?= e($contact['email']) ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-white-50 small">No hay mensajes de contacto recientes.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
