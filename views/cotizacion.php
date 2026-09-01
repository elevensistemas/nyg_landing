<section class="page-hero" data-animate>
    <div class="container text-center py-5">
        <p class="eyebrow">Cotización</p>
        <h1>Solicitá tu cotización</h1>
        <p class="lead-text max-w-600 mx-auto text-white-50 mt-3">
            Completá los datos que tengas disponibles. Cuanta más información nos des, más precisa va a ser la propuesta.
        </p>
    </div>
</section>

<section class="section-dark py-5" data-animate>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-start">
                <form method="POST" action="<?= route('cotizacion.store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Paso 1: Datos de contacto -->
                    <fieldset class="mb-5 p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                        <legend class="text-warning h5 mb-4 fw-bold">1. Tus datos de contacto</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_name" class="form-label text-white">Nombre y apellido *</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="contact_name" name="contact_name" value="<?= e(old('contact_name')) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label text-white">Empresa *</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="company_name" name="company_name" value="<?= e(old('company_name')) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-white">Correo electrónico *</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="<?= e(old('email')) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label text-white">Teléfono *</label>
                                <input type="tel" class="form-control bg-dark text-white border-secondary" id="phone" name="phone" value="<?= e(old('phone')) ?>" required>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Paso 2: Detalle de la operación -->
                    <fieldset class="mb-5 p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                        <legend class="text-warning h5 mb-4 fw-bold">2. Detalle de la operación</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="origin_city" class="form-label text-white">Origen *</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="origin_city" name="origin_city" value="<?= e(old('origin_city')) ?>" required placeholder="Ej: Buenos Aires">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="destination_city" class="form-label text-white">Destino *</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="destination_city" name="destination_city" value="<?= e(old('destination_city')) ?>" required placeholder="Ej: Rosario, Santa Fe">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cargo_type" class="form-label text-white">Tipo de mercadería *</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="cargo_type" name="cargo_type" value="<?= e(old('cargo_type')) ?>" required placeholder="Ej: Alimentos, Repuestos, Palletizado">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cargo_weight" class="form-label text-white">Peso aproximado (kg)</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="cargo_weight" name="cargo_weight" value="<?= e(old('cargo_weight')) ?>">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Paso 3: Volumen y comentarios -->
                    <fieldset class="mb-5 p-4 rounded-4 border border-secondary-subtle" style="background-color: #111;">
                        <legend class="text-warning h5 mb-4 fw-bold">3. Detalles adicionales y adjunto</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cargo_volume" class="form-label text-white">Volumen aproximado (m³ / pallets)</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="cargo_volume" name="cargo_volume" value="<?= e(old('cargo_volume')) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="frequency" class="form-label text-white">Frecuencia del servicio</label>
                                <select class="form-select bg-dark text-white border-secondary" id="frequency" name="frequency">
                                    <option value="Única vez">Única vez</option>
                                    <option value="Semanal">Semanal</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Recurrente / a definir">Recurrente / a definir</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="comments" class="form-label text-white">Comentarios</label>
                                <textarea class="form-control bg-dark text-white border-secondary" id="comments" name="comments" rows="4"><?= e(old('comments')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="attachment" class="form-label text-white">Archivo adjunto (opcional)</label>
                                <input type="file" class="form-control bg-dark text-white border-secondary" id="attachment" name="attachment">
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-premium-yellow btn-lg px-5">Solicitar cotización</button>
                </form>
            </div>
        </div>
    </div>
</section>
