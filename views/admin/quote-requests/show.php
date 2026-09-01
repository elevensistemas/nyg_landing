<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white h4 mb-0">Detalle de Cotización #<?= $quoteRequest['id'] ?></h2>
    <a href="/admin/quote-requests" class="btn btn-outline-light btn-sm">Volver</a>
</div>

<div class="row g-4 text-start">
    <div class="col-md-8">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 text-warning mb-3">Información del Cliente y Operación</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Empresa:</strong>
                    <span class="fs-5 text-white"><?= e($quoteRequest['company_name']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Contacto:</strong>
                    <span class="fs-5 text-white"><?= e($quoteRequest['contact_name']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Email:</strong>
                    <a href="mailto:<?= e($quoteRequest['email']) ?>" class="text-warning"><?= e($quoteRequest['email']) ?></a>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Teléfono:</strong>
                    <span class="text-white"><?= e($quoteRequest['phone']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Origen:</strong>
                    <span class="text-white"><?= e($quoteRequest['origin_city']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Destino:</strong>
                    <span class="text-white"><?= e($quoteRequest['destination_city']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Tipo de Carga:</strong>
                    <span class="text-white"><?= e($quoteRequest['cargo_type']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Frecuencia:</strong>
                    <span class="text-white"><?= e($quoteRequest['frequency'] ?: 'N/A') ?></span>
                </div>
                <div class="col-12 mt-3">
                    <strong class="text-white-50 d-block">Comentarios:</strong>
                    <p class="p-3 rounded-3 bg-secondary bg-opacity-25 text-white mt-1 mb-0"><?= e($quoteRequest['comments'] ?: 'Sin comentarios') ?></p>
                </div>
                <?php if (!empty($quoteRequest['attachments'])): ?>
                    <div class="col-12 mt-3">
                        <strong class="text-white-50 d-block">Archivos Adjuntos:</strong>
                        <?php foreach ($quoteRequest['attachments'] as $att): ?>
                            <a href="<?= e($att['file_path']) ?>" target="_blank" class="btn btn-sm btn-outline-warning mt-2">
                                📎 <?= e($att['file_name']) ?>
                            </a>
                        <?php foreach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 text-warning mb-3">Actualizar Estado</h3>
            <form method="POST" action="/admin/quote-requests/<?= $quoteRequest['id'] ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="status" class="form-label text-white">Estado</label>
                    <select class="form-select bg-dark text-white border-secondary" id="status" name="status">
                        <option value="pending" <?= $quoteRequest['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="contacted" <?= $quoteRequest['status'] === 'contacted' ? 'selected' : '' ?>>Contactado</option>
                        <option value="quoted" <?= $quoteRequest['status'] === 'quoted' ? 'selected' : '' ?>>Cotizado</option>
                        <option value="closed" <?= $quoteRequest['status'] === 'closed' ? 'selected' : '' ?>>Cerrado / Ganado</option>
                        <option value="rejected" <?= $quoteRequest['status'] === 'rejected' ? 'selected' : '' ?>>Rechazado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label text-white">Notas Internas</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="notes" name="notes" rows="4"><?= e($quoteRequest['notes'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning fw-bold w-100">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
