<div class="h4 text-white mb-4">Configuración General del Sitio</div>

<form method="POST" action="/admin/settings" class="p-4 rounded-4 border border-secondary bg-dark text-white text-start">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="card bg-black border-warning border-opacity-50 rounded-4 mb-4 text-white">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                <div>
                    <h5 class="card-title text-warning fw-bold mb-1">
                        <i class="bi bi-tools me-2"></i>Estado del Sitio Web: Modo Construcción / Mantenimiento
                    </h5>
                    <p class="text-white-50 small mb-0">
                        Al activar este switch, los visitantes verán la pantalla institucional de "Página en Construcción" con el logo, colores y datos de contacto de NYG. El panel admin seguirá accesible normalmente.
                    </p>
                </div>
                <div class="form-check form-switch form-switch-lg">
                    <?php $isUnderConstruction = ($settings['under_construction'] ?? '0') === '1'; ?>
                    <input class="form-check-input bg-dark border-secondary" type="checkbox" role="switch" id="under_construction" name="under_construction" value="1" <?= $isUnderConstruction ? 'checked' : '' ?> style="width: 3rem; height: 1.6rem; cursor: pointer;">
                    <label class="form-check-label fw-bold ms-2 <?= $isUnderConstruction ? 'text-warning' : 'text-white-50' ?>" for="under_construction" id="switch-status-label">
                        <?= $isUnderConstruction ? 'ACTIVO (En Construcción)' : 'INACTIVO (Sitio Visible)' ?>
                    </label>
                </div>
            </div>

            <div class="row g-3 mt-2 border-top border-secondary border-opacity-50 pt-3">
                <div class="col-md-6">
                    <label for="under_construction_title" class="form-label text-white-50 small">Título de la pantalla de construcción (Opcional)</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="under_construction_title" name="under_construction_title" value="<?= e($settings['under_construction_title'] ?? 'Estamos renovando nuestra plataforma web') ?>" placeholder="Ej: Estamos renovando nuestra plataforma web">
                </div>
                <div class="col-md-6">
                    <label for="under_construction_text" class="form-label text-white-50 small">Subtítulo / Mensaje adicional (Opcional)</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="under_construction_text" name="under_construction_text" value="<?= e($settings['under_construction_text'] ?? 'Muy pronto estará disponible la nueva experiencia digital de NYG Transporte & Logística.') ?>" placeholder="Ej: Muy pronto estará disponible la nueva experiencia digital...">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('under_construction')?.addEventListener('change', function() {
            const label = document.getElementById('switch-status-label');
            if (this.checked) {
                label.textContent = 'ACTIVO (En Construcción)';
                label.className = 'form-check-label fw-bold ms-2 text-warning';
            } else {
                label.textContent = 'INACTIVO (Sitio Visible)';
                label.className = 'form-check-label fw-bold ms-2 text-white-50';
            }
        });
    </script>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="brand_name" class="form-label text-white">Nombre de Marca</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="brand_name" name="brand_name" value="<?= e($settings['brand_name'] ?? 'NYG Transporte') ?>">
        </div>
        <div class="col-md-6">
            <label for="contact_email" class="form-label text-white">Email de Contacto</label>
            <input type="email" class="form-control bg-dark text-white border-secondary" id="contact_email" name="contact_email" value="<?= e($settings['contact_email'] ?? 'contacto@nygtransporte.com.ar') ?>">
        </div>
        <div class="col-md-6">
            <label for="contact_phone_display" class="form-label text-white">Teléfono Visible</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="contact_phone_display" name="contact_phone_display" value="<?= e($settings['contact_phone_display'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label for="whatsapp_number" class="form-label text-white">Número de WhatsApp (con código de país sin +)</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="whatsapp_number" name="whatsapp_number" value="<?= e($settings['whatsapp_number'] ?? '5491100000000') ?>">
        </div>
        <div class="col-12">
            <label for="address" class="form-label text-white">Dirección Física</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="address" name="address" value="<?= e($settings['address'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label for="facebook_url" class="form-label text-white">URL Facebook</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="facebook_url" name="facebook_url" value="<?= e($settings['facebook_url'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label for="instagram_url" class="form-label text-white">URL Instagram</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="instagram_url" name="instagram_url" value="<?= e($settings['instagram_url'] ?? '') ?>">
        </div>
        <div class="col-12">
            <label for="social_linkedin" class="form-label text-white">URL LinkedIn</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="social_linkedin" name="social_linkedin" value="<?= e($settings['social_linkedin'] ?? '') ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-warning fw-bold px-4 mt-4">Guardar Configuración</button>
</form>
