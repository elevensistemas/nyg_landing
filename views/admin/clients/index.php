<div class="h4 text-white mb-4">Gestión de Clientes</div>

<div class="row g-4 text-start">
    <div class="col-md-5">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 mb-3 text-warning">Agregar Cliente</h3>
            <form method="POST" action="/admin/clients">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Nombre de la Empresa *</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="logo_url" class="form-label text-white">URL del Logo (o /images/...)</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="logo_url" name="logo_url" placeholder="/images/client-logo.png">
                </div>
                <button type="submit" class="btn btn-warning fw-bold">Guardar Cliente</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="table-responsive rounded-4 border border-secondary bg-dark">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td>
                                <?php if ($client['logo_url']): ?>
                                    <img src="<?= e($client['logo_url']) ?>" alt="Logo" style="height: 30px;">
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-white"><?= e($client['name']) ?></td>
                            <td class="text-end">
                                <form method="POST" action="/admin/clients/<?= $client['id'] ?>" class="d-inline" onsubmit="return confirm('¿Eliminar cliente?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
