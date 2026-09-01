<div class="h4 text-white mb-4">Páginas Legales</div>

<div class="table-responsive rounded-4 border border-secondary bg-dark text-start">
    <table class="table table-dark table-hover mb-0 align-middle">
        <thead>
            <tr>
                <th>Título</th>
                <th>Slug</th>
                <th class="text-end">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($legalPages as $page): ?>
                <tr>
                    <td class="fw-bold text-white"><?= e($page['title']) ?></td>
                    <td><code><?= e($page['slug']) ?></code></td>
                    <td class="text-end">
                        <a href="/admin/legal-pages/<?= $page['id'] ?>/edit" class="btn btn-sm btn-outline-warning">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
