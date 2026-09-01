<?php
$whatsappNumber = \App\Models\Setting::get('whatsapp_number', '5491100000000');
$whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera solicitar información sobre transporte.');
?>

<section class="page-hero" data-animate>
    <div class="container text-center py-5">
        <p class="eyebrow">Contacto</p>
        <h1>Contanos qué necesitás mover. Nosotros diseñamos cómo hacerlo.</h1>
    </div>
</section>

<section class="section-dark py-5" data-animate>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 text-start">
                <h2 class="text-white mb-4">Datos de contacto</h2>
                <ul class="contact-list contact-list-light list-unstyled text-white-50 fs-6 mb-4">
                    <li class="mb-2"><strong class="text-white">Teléfono / WhatsApp:</strong> <?= e(\App\Models\Setting::get('contact_phone_display')) ?></li>
                    <li class="mb-2"><strong class="text-white">Correo:</strong> <a href="mailto:<?= e(\App\Models\Setting::get('contact_email')) ?>" class="text-warning"><?= e(\App\Models\Setting::get('contact_email')) ?></a></li>
                    <li class="mb-2"><strong class="text-white">Dirección:</strong> <?= e(\App\Models\Setting::get('address')) ?></li>
                </ul>
                <a href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener" class="btn btn-whatsapp-header mb-4">Escribir por WhatsApp</a>
            </div>

            <div class="col-lg-7 text-start">
                <h2 class="text-white mb-4">Formulario de contacto</h2>
                <form method="POST" action="<?= route('contacto.store') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label text-white">Nombre y apellido *</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" value="<?= e(old('name')) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label text-white">Correo electrónico *</label>
                            <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="<?= e(old('email')) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label text-white">Teléfono</label>
                            <input type="tel" class="form-control bg-dark text-white border-secondary" id="phone" name="phone" value="<?= e(old('phone')) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label text-white">Mensaje *</label>
                        <textarea class="form-control bg-dark text-white border-secondary" id="message" name="message" rows="5" required><?= e(old('message')) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-premium-yellow">Enviar mensaje</button>
                    <a href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener" class="btn btn-premium-outline ms-2">O escribinos por WhatsApp</a>
                </form>
            </div>
        </div>
    </div>
</section>
