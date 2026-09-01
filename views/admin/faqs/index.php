<div class="h4 text-white mb-4">Preguntas Frecuentes (FAQs)</div>

<div class="row g-4 text-start">
    <div class="col-md-5">
        <div class="p-4 rounded-4 border border-secondary bg-dark text-white">
            <h3 class="h5 mb-3 text-warning">Agregar FAQ</h3>
            <form method="POST" action="/admin/faqs">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="question" class="form-label text-white">Pregunta *</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="question" name="question" required>
                </div>
                <div class="mb-3">
                    <label for="answer" class="form-label text-white">Respuesta *</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="answer" name="answer" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning fw-bold">Guardar FAQ</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="table-responsive rounded-4 border border-secondary bg-dark">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Pregunta</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $faq): ?>
                        <tr>
                            <td>
                                <strong class="text-white d-block"><?= e($faq['question']) ?></strong>
                                <small class="text-white-50"><?= e($faq['answer']) ?></small>
                            </td>
                            <td class="text-end">
                                <form method="POST" action="/admin/faqs/<?= $faq['id'] ?>" class="d-inline" onsubmit="return confirm('¿Eliminar FAQ?')">
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
