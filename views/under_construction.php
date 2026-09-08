<?php
use App\Models\Setting;

$brandName = Setting::get('brand_name', 'NYG Transporte');
$contactEmail = Setting::get('contact_email', 'contacto@nygtransporte.com.ar');
$contactPhone = Setting::get('contact_phone_display', '+54 (11) 7063-9810');
$whatsappNumber = Setting::get('whatsapp_number', '5491178560714');
$address = Setting::get('address', 'Buenos Aires, Argentina');
$facebookUrl = Setting::get('facebook_url', 'https://www.facebook.com/nygtransporteok/');
$instagramUrl = Setting::get('instagram_url', 'https://www.instagram.com/nyg_transporte/');
$linkedinUrl = Setting::get('social_linkedin', 'https://www.linkedin.com/company/nyg-transporte/');

$customTitle = Setting::get('under_construction_title', 'Estamos renovando nuestra plataforma digital');
$customText = Setting::get('under_construction_text', 'Estamos trabajando para brindarte una mejor experiencia en soluciones de logística integral, transporte y distribución.');
$whatsappHref = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode('Hola, quisiera comunicarme con NYG Transporte.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($brandName) ?> — Página en Construcción</title>
    <meta name="description" content="<?= e($customText) ?>">
    <link rel="icon" href="<?= e(asset('images/IMG_6177.PNG')) ?>" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --nyg-navy-dark: #070c18;
            --nyg-navy-card: #0e172a;
            --nyg-yellow: #f59e0b;
            --nyg-yellow-light: #fbbf24;
            --nyg-yellow-glow: rgba(245, 158, 11, 0.25);
            --nyg-text: #f8fafc;
            --nyg-text-muted: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--nyg-navy-dark);
            color: var(--nyg-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient background glow */
        .bg-glow-1 {
            position: absolute;
            top: -10%;
            left: 20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, rgba(7, 12, 24, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .bg-glow-2 {
            position: absolute;
            bottom: -10%;
            right: 15%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(30, 58, 138, 0.25) 0%, rgba(7, 12, 24, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .construction-card {
            background: rgba(14, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 30px var(--nyg-yellow-glow);
            z-index: 1;
            position: relative;
            overflow: hidden;
        }

        .construction-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);
            background-size: 200% 100%;
            animation: gradientMove 4s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .brand-logo {
            max-height: 90px;
            width: auto;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--nyg-yellow-light);
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .pulse-dot {
            width: 10px;
            height: 10px;
            background-color: var(--nyg-yellow);
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        h1 {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
        }

        .text-gradient-yellow {
            background: linear-gradient(135deg, #ffffff 30%, var(--nyg-yellow-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-whatsapp-nyg {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
            text-decoration: none;
        }

        .btn-whatsapp-nyg:hover {
            background: #20ba5a;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        }

        .btn-contact-nyg {
            background: rgba(255, 255, 255, 0.07);
            color: var(--nyg-text);
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 14px 28px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-contact-nyg:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-color: var(--nyg-yellow);
            transform: translateY(-2px);
        }

        .contact-info-pill {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 16px 20px;
            transition: border-color 0.3s ease;
        }

        .contact-info-pill:hover {
            border-color: rgba(245, 158, 11, 0.4);
        }

        .social-link {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--nyg-text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-link:hover {
            background: var(--nyg-yellow);
            color: var(--nyg-navy-dark);
            border-color: var(--nyg-yellow);
            transform: translateY(-3px);
        }

        .admin-login-link {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .admin-login-link:hover {
            color: var(--nyg-yellow);
        }
    </style>
</head>
<body>

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="construction-card p-4 p-md-5 text-center">

                    <!-- Logo NYG -->
                    <div class="mb-4">
                        <img src="<?= asset('images/IMG_6178.PNG') ?>" alt="NYG Transporte & Logística" class="brand-logo mb-2">
                    </div>

                    <!-- Badge estado -->
                    <div class="mb-4">
                        <span class="status-badge">
                            <span class="pulse-dot"></span>
                            Sitio en Renovación / Mantenimiento
                        </span>
                    </div>

                    <!-- Título principal -->
                    <h1 class="display-6 mb-3 text-gradient-yellow">
                        <?= e($customTitle) ?>
                    </h1>

                    <!-- Texto descriptivo -->
                    <p class="lead text-white-50 mb-4 fs-6 px-md-3">
                        <?= e($customText) ?>
                    </p>

                    <!-- Acciones principales -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-5">
                        <?php if (!empty($whatsappNumber)): ?>
                        <a href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener" class="btn-whatsapp-nyg justify-content-center">
                            <i class="bi bi-whatsapp fs-5"></i>
                            Contactar por WhatsApp
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($contactEmail)): ?>
                        <a href="mailto:<?= e($contactEmail) ?>" class="btn-contact-nyg justify-content-center">
                            <i class="bi bi-envelope-fill text-warning fs-5"></i>
                            Enviar Email
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Grilla de datos de contacto directo -->
                    <div class="row g-3 mb-4 text-start">
                        <?php if (!empty($contactPhone)): ?>
                        <div class="col-md-6">
                            <div class="contact-info-pill d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                                    <i class="bi bi-telephone-fill fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-white-50 small">Atención Telefónica</div>
                                    <div class="fw-bold text-white"><?= e($contactPhone) ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($address)): ?>
                        <div class="col-md-6">
                            <div class="contact-info-pill d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-white-50 small">Oficina Central</div>
                                    <div class="fw-bold text-white"><?= e($address) ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Redes sociales y footer -->
                    <div class="pt-3 border-top border-white-10 d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <?php if (!empty($facebookUrl)): ?>
                            <a href="<?= e($facebookUrl) ?>" target="_blank" rel="noopener" class="social-link" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (!empty($instagramUrl)): ?>
                            <a href="<?= e($instagramUrl) ?>" target="_blank" rel="noopener" class="social-link" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (!empty($linkedinUrl)): ?>
                            <a href="<?= e($linkedinUrl) ?>" target="_blank" rel="noopener" class="social-link" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <?php endif; ?>
                        </div>

                        <div class="text-white-50 small">
                            © <?= date('Y') ?> NYG Transporte. Todos los derechos reservados.
                        </div>

                        <div>
                            <a href="/admin/login" class="admin-login-link" title="Acceso al Panel de Administración">
                                <i class="bi bi-lock-fill me-1"></i>Acceso Admin
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
