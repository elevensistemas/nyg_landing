<?php if ($success = flash('success')): ?>
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= e($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    </div>
<?php endif; ?>

<?php if ($error = flash('error')): ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?= e($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    </div>
<?php endif; ?>
