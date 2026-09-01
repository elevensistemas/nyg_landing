<div class="h4 text-white mb-4">Configuración General del Sitio</div>

<form method="POST" action="/admin/settings" class="p-4 rounded-4 border border-secondary bg-dark text-white text-start">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

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
    </div>

    <button type="submit" class="btn btn-warning fw-bold px-4 mt-4">Guardar Configuración</button>
</form>
