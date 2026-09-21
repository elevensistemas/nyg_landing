<?php
use App\Models\Setting;
$whatsappNumber = Setting::get('whatsapp_number', '5491130091907');
$whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera cotizar una operación logística.');
$preselected = $_GET['servicio'] ?? '';
$errors = $_SESSION['_errors'] ?? [];
$old = $_SESSION['_old'] ?? [];
unset($_SESSION['_errors'], $_SESSION['_old']);
?>

<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Cotización</p>
        <h1>Solicitá tu cotización</h1>
        <p class="lead-text">
            Completá los datos que tengas disponibles. Ningún campo operativo es obligatorio salvo tus datos de contacto:
            cuanta más información nos des, más precisa va a ser la propuesta.
        </p>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <form method="POST" action="<?= route('cotizacion.store') ?>" enctype="multipart/form-data" novalidate data-quote-form>
                    <?= csrf_field() ?>
                    <div class="visually-hidden" aria-hidden="true">
                        <label for="website">No completar este campo</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>

                    <?php // Paso 1: Datos de contacto ?>
                    <fieldset class="form-step" data-step="1">
                        <legend>1. Tus datos de contacto</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Nombre y apellido *</label>
                                <input type="text" class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>" id="full_name" name="full_name" value="<?= htmlspecialchars($old['full_name'] ?? '') ?>" required>
                                <?php if (isset($errors['full_name'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['full_name']) ?></div><?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Empresa</label>
                                <input type="text" class="form-control" id="company" name="company" value="<?= htmlspecialchars($old['company'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo electrónico *</label>
                                <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                                <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div><?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono *</label>
                                <input type="tel" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>" required>
                                <?php if (isset($errors['phone'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['phone']) ?></div><?php endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <?php // Paso 2: Detalle de la operación ?>
                    <fieldset class="form-step" data-step="2">
                        <legend>2. Detalle de la operación</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="service_id" class="form-label">Tipo de servicio</label>
                                <select class="form-select" id="service_id" name="service_id">
                                    <option value="">Seleccionar...</option>
                                    <?php foreach($services as $service): ?>
                                        <?php 
                                        $selected = false;
                                        if (isset($old['service_id'])) {
                                            $selected = ($old['service_id'] == $service['id']);
                                        } else {
                                            $selected = ($preselected == $service['slug'] || $preselected == $service['id']);
                                        }
                                        ?>
                                        <option value="<?= $service['id'] ?>" <?= $selected ? 'selected' : '' ?>><?= htmlspecialchars($service['name']) ?></option>
                                    <?php endforeach; ?>
                                    <option value="">Otro (especificar abajo)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_type_other" class="form-label">Otro servicio (si no está en la lista)</label>
                                <input type="text" class="form-control" id="service_type_other" name="service_type_other" value="<?= htmlspecialchars($old['service_type_other'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="origin" class="form-label">Origen</label>
                                <input type="text" class="form-control" id="origin" name="origin" value="<?= htmlspecialchars($old['origin'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destino</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="<?= htmlspecialchars($old['destination'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cargo_type" class="form-label">Tipo de mercadería</label>
                                <input type="text" class="form-control" id="cargo_type" name="cargo_type" value="<?= htmlspecialchars($old['cargo_type'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="requires_temperature_control" name="requires_temperature_control" value="1" <?= !empty($old['requires_temperature_control']) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="requires_temperature_control">Requiere temperatura controlada</label>
                                </div>
                                <input type="text" class="form-control mt-2" id="temperature_requirement" name="temperature_requirement" placeholder="Ej: congelado, supercongelado, refrigerado" value="<?= htmlspecialchars($old['temperature_requirement'] ?? '') ?>">
                            </div>
                        </div>
                    </fieldset>

                    <?php // Paso 3: Volumen y frecuencia ?>
                    <fieldset class="form-step" data-step="3">
                        <legend>3. Volumen y frecuencia</legend>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="approx_weight_kg" class="form-label">Peso aproximado (kg)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="approx_weight_kg" name="approx_weight_kg" value="<?= htmlspecialchars($old['approx_weight_kg'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="approx_volume_m3" class="form-label">Volumen aproximado (m³)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="approx_volume_m3" name="approx_volume_m3" value="<?= htmlspecialchars($old['approx_volume_m3'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pallets_or_packages" class="form-label">Cantidad de pallets o bultos</label>
                                <input type="number" min="0" class="form-control" id="pallets_or_packages" name="pallets_or_packages" value="<?= htmlspecialchars($old['pallets_or_packages'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="frequency" class="form-label">Frecuencia del servicio</label>
                                <select class="form-select" id="frequency" name="frequency">
                                    <option value="">Seleccionar...</option>
                                    <option value="Única vez" <?= ($old['frequency'] ?? '') === 'Única vez' ? 'selected' : '' ?>>Única vez</option>
                                    <option value="Semanal" <?= ($old['frequency'] ?? '') === 'Semanal' ? 'selected' : '' ?>>Semanal</option>
                                    <option value="Quincenal" <?= ($old['frequency'] ?? '') === 'Quincenal' ? 'selected' : '' ?>>Quincenal</option>
                                    <option value="Mensual" <?= ($old['frequency'] ?? '') === 'Mensual' ? 'selected' : '' ?>>Mensual</option>
                                    <option value="Recurrente / a definir" <?= ($old['frequency'] ?? '') === 'Recurrente / a definir' ? 'selected' : '' ?>>Recurrente / a definir</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estimated_date" class="form-label">Fecha estimada</label>
                                <input type="date" class="form-control <?= isset($errors['estimated_date']) ? 'is-invalid' : '' ?>" id="estimated_date" name="estimated_date" value="<?= htmlspecialchars($old['estimated_date'] ?? '') ?>">
                                <?php if (isset($errors['estimated_date'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['estimated_date']) ?></div><?php endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <?php // Paso 4: Comentarios y adjunto ?>
                    <fieldset class="form-step" data-step="4">
                        <legend>4. Comentarios y adjunto</legend>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comentarios</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4"><?= htmlspecialchars($old['comments'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Archivo adjunto (opcional)</label>
                            <input type="file" class="form-control <?= isset($errors['attachment']) ? 'is-invalid' : '' ?>" id="attachment" name="attachment">
                            <div class="form-text">PDF, imagen, Excel o Word. Máximo 5 MB.</div>
                            <?php if (isset($errors['attachment'])): ?><div class="invalid-feedback d-block"><?= htmlspecialchars($errors['attachment']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input <?= isset($errors['privacy_consent']) ? 'is-invalid' : '' ?>" type="checkbox" id="privacy_consent" name="privacy_consent" value="1" required>
                            <label class="form-check-label" for="privacy_consent">
                                Acepto la <a href="<?= route('legal.show', ['legal' => 'politica-de-privacidad']) ?>" target="_blank">política de privacidad</a> para el tratamiento de mis datos.
                            </label>
                            <?php if (isset($errors['privacy_consent'])): ?><div class="invalid-feedback d-block"><?= htmlspecialchars($errors['privacy_consent']) ?></div><?php endif; ?>
                        </div>
                    </fieldset>

                    <div class="form-step-nav">
                        <button type="button" class="btn btn-outline-dark" data-step-prev>Anterior</button>
                        <button type="button" class="btn btn-cta" data-step-next>Siguiente</button>
                        <button type="submit" class="btn btn-cta" data-step-submit style="display:none;">Enviar solicitud</button>
                    </div>

                    <p class="mt-3">
                        ¿Preferís hablar directamente? <a href="<?= $whatsappHref ?>" target="_blank" rel="noopener">Continuar por WhatsApp</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
