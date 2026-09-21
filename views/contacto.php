<?php
use App\Models\Setting;
$whatsappNumber = Setting::get('whatsapp_number', '5491130091907');
$whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera solicitar información sobre transporte.');
$errors = $_SESSION['_errors'] ?? [];
$old = $_SESSION['_old'] ?? [];
// Clear session errors/old input after retrieval
unset($_SESSION['_errors'], $_SESSION['_old']);
?>

<section class="page-hero" data-animate>
    <div class="container">
        <p class="eyebrow">Contacto</p>
        <h1>Contanos qué necesitás mover. Nosotros diseñamos cómo hacerlo.</h1>
    </div>
</section>

<section class="section-light" data-animate>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2>Datos de contacto</h2>
                <ul class="contact-list contact-list-light">
                    <li><strong>Teléfono / WhatsApp:</strong> <?= htmlspecialchars(Setting::get('contact_phone_display')) ?></li>
                    <li><strong>Correo:</strong> <a href="mailto:<?= htmlspecialchars(Setting::get('contact_email')) ?>"><?= htmlspecialchars(Setting::get('contact_email')) ?></a></li>
                    <li><strong>Dirección:</strong> <?= htmlspecialchars(Setting::get('address')) ?></li>
                    <?php if(Setting::get('business_hours')): ?>
                        <li><strong>Horario:</strong> <?= htmlspecialchars(Setting::get('business_hours')) ?></li>
                    <?php endif; ?>
                </ul>
                <a href="<?= $whatsappHref ?>" target="_blank" rel="noopener" class="btn btn-whatsapp mb-3">Escribir por WhatsApp</a>

                <div class="map-embed">
                    <iframe
                        title="Ubicación de NYG Transporte"
                        src="https://maps.google.com/maps?q=<?= urlencode(Setting::get('address', 'Buenos Aires, Argentina')) ?>&t=m&z=15&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="border:0;width:100%;height:280px;border-radius:12px;">
                    </iframe>
                </div>
            </div>

            <div class="col-lg-7">
                <h2>Formulario de contacto</h2>
                <form method="POST" action="<?= route('contacto.store') ?>" novalidate data-ajax-form>
                    <?= csrf_field() ?>
                    <?php // Honeypot anti-spam: campo oculto, no debe completarse ?>
                    <div class="visually-hidden" aria-hidden="true">
                        <label for="website">No completar este campo</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre y apellido *</label>
                        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
                        <?php if (isset($errors['name'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div><?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico *</label>
                            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                            <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div><?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                            <?php if (isset($errors['phone'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['phone']) ?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje *</label>
                        <textarea class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>" id="message" name="message" rows="5" required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                        <?php if (isset($errors['message'])): ?><div class="invalid-feedback"><?= htmlspecialchars($errors['message']) ?></div><?php endif; ?>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input <?= isset($errors['privacy_consent']) ? 'is-invalid' : '' ?>" type="checkbox" id="privacy_consent" name="privacy_consent" value="1" required>
                        <label class="form-check-label" for="privacy_consent">
                            Acepto la <a href="<?= route('legal.show', ['legal' => 'politica-de-privacidad']) ?>" target="_blank">política de privacidad</a> para el tratamiento de mis datos.
                        </label>
                        <?php if (isset($errors['privacy_consent'])): ?><div class="invalid-feedback d-block"><?= htmlspecialchars($errors['privacy_consent']) ?></div><?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-cta">Enviar mensaje</button>
                    <a href="<?= $whatsappHref ?>" target="_blank" rel="noopener" class="btn btn-outline-dark ms-2">O escribinos por WhatsApp</a>

                    <div class="form-status mt-3" data-form-status role="status" aria-live="polite"></div>
                </form>
            </div>
        </div>
    </div>
</section>
