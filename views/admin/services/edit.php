<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white h4 mb-0">Editar Servicio</h2>
    <a href="/admin/services" class="btn btn-outline-light btn-sm">Volver</a>
</div>

<form method="POST" action="/admin/services/<?= $service['id'] ?>" class="p-4 rounded-4 border border-secondary bg-dark text-white text-start">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="title" class="form-label text-white">Título *</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="title" name="title" value="<?= e($service['title']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="slug" class="form-label text-white">Slug (URL amigable)</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="slug" name="slug" value="<?= e($service['slug']) ?>">
        </div>
        <div class="col-12 mb-3">
            <label for="summary" class="form-label text-white">Resumen / Descripción Corta</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="summary" name="summary" value="<?= e($service['summary'] ?? '') ?>">
        </div>
        <div class="col-12 mb-3">
            <label for="description" class="form-label text-white">Descripción Completa</label>
            <textarea class="form-control bg-dark text-white border-secondary" id="description" name="description" rows="6"><?= e($service['description'] ?? '') ?></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= $service['is_active'] ? 'checked' : '' ?>>
                <label class="form-check-label text-white" for="is_active">Servicio Activo</label>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" <?= $service['is_featured'] ? 'checked' : '' ?>>
                <label class="form-check-label text-white" for="is_featured">Servicio Destacado en Inicio</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-warning fw-bold px-4">Actualizar Servicio</button>
</form>
