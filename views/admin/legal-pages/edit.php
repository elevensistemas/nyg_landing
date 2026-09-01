<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white h4 mb-0">Editar <?= e($page['title']) ?></h2>
    <a href="/admin/legal-pages" class="btn btn-outline-light btn-sm">Volver</a>
</div>

<form method="POST" action="/admin/legal-pages/<?= $page['id'] ?>" class="p-4 rounded-4 border border-secondary bg-dark text-white text-start">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="row g-3">
        <div class="col-md-6">
            <label for="title" class="form-label text-white">Título *</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="title" name="title" value="<?= e($page['title']) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="slug" class="form-label text-white">Slug</label>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="slug" name="slug" value="<?= e($page['slug']) ?>">
        </div>
        <div class="col-12">
            <label for="content" class="form-label text-white">Contenido HTML / Texto</label>
            <textarea class="form-control bg-dark text-white border-secondary" id="content" name="content" rows="12" required><?= e($page['content']) ?></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-warning fw-bold px-4 mt-4">Guardar Cambios</button>
</form>
