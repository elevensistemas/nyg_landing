<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white h4 mb-0">Detalle de Mensaje #<?= $contactRequest['id'] ?></h2>
    <a href="/admin/contact-requests" class="btn btn-outline-light btn-sm">Volver</a>
</div>

<div class="row g-4 text-start">
    <div class="col-md-8">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 text-warning mb-3">Mensaje Recibido</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Nombre:</strong>
                    <span class="fs-5 text-white"><?= e($contactRequest['name']) ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Empresa:</strong>
                    <span class="fs-5 text-white"><?= e($contactRequest['company'] ?: 'N/A') ?></span>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Email:</strong>
                    <a href="mailto:<?= e($contactRequest['email']) ?>" class="text-warning"><?= e($contactRequest['email']) ?></a>
                </div>
                <div class="col-md-6">
                    <strong class="text-white-50 d-block">Teléfono:</strong>
                    <span class="text-white"><?= e($contactRequest['phone'] ?: 'N/A') ?></span>
                </div>
                <div class="col-12 mt-3">
                    <strong class="text-white-50 d-block">Mensaje:</strong>
                    <p class="p-3 rounded-3 bg-secondary bg-opacity-25 text-white mt-1 mb-0" style="white-space: pre-wrap;"><?= e($contactRequest['message']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 text-warning mb-3">Estado del Mensaje</h3>
            <form method="POST" action="/admin/contact-requests/<?= $contactRequest['id'] ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="status" class="form-label text-white">Estado</label>
                    <select class="form-select bg-dark text-white border-secondary" id="status" name="status">
                        <option value="pending" <?= $contactRequest['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="responded" <?= $contactRequest['status'] === 'responded' ? 'selected' : '' ?>>Respondido</option>
                        <option value="archived" <?= $contactRequest['status'] === 'archived' ? 'selected' : '' ?>>Archivado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label text-white">Notas Internas</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="notes" name="notes" rows="4"><?= e($contactRequest['notes'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning fw-bold w-100">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
