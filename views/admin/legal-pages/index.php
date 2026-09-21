<div class="table-responsive">
    <table class="table admin-table">
        <thead><tr><th>Título</th><th>Última revisión</th><th>Publicada</th><th></th></tr></thead>
        <tbody>
            <?php foreach($pages as $page): ?>
                <tr>
                    <td><?= htmlspecialchars($page['title']) ?></td>
                    <td><?= !empty($page['last_reviewed_at']) ? date('d/m/Y', strtotime($page['last_reviewed_at'])) : 'Sin revisar' ?></td>
                    <td><?= !empty($page['is_published']) ? 'Sí' : 'No' ?></td>
                    <td><a href="<?= route('admin.legal-pages.edit', ['id' => $page['id']]) ?>">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<p class="text-muted">Recordá que estos textos deben ser validados por un profesional legal antes de su publicación definitiva.</p>
