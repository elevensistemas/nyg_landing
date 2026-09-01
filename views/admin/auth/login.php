<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card bg-dark text-white border border-secondary rounded-4 shadow">
            <div class="card-body p-4 text-start">
                <div class="text-center mb-4">
                    <h2 class="h4 text-warning fw-bold">NYG Admin</h2>
                    <p class="text-white-50 small">Ingresá tus credenciales para acceder al CMS</p>
                </div>
                <form method="POST" action="/admin/login">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Correo electrónico</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label text-white">Contraseña</label>
                        <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
