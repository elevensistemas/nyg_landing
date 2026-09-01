<?php
$whatsappNumber = \App\Models\Setting::get('whatsapp_number', '5491100000000');
$whatsappHref = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Hola, quisiera solicitar información sobre transporte.');
?>

<header class="site-header sticky-top" data-header>
    <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Navegación principal">
        <div class="container position-relative">
            <a class="navbar-brand" href="<?= route('home') ?>">
                <img src="<?= asset('images/logo-nyg.png') ?>" alt="NYG Logística Integral" class="header-logo" height="54">
            </a>

            <div class="d-flex align-items-center gap-2 ms-auto order-lg-last">
                <a class="btn btn-premium-cta" href="<?= route('cotizacion') ?>">Solicitar cotización</a>
                
                <button class="navbar-toggler border-0 ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navPrincipal"
                    aria-controls="navPrincipal" aria-expanded="false" aria-label="Abrir menú de navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navPrincipal">
                <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="<?= route('home') ?>">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= route('home') ?>#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= route('home') ?>#tecnologia">Tecnología</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= route('empresa') ?>">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= route('contacto') ?>">Contacto</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-whatsapp-header" href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-whatsapp me-1" viewBox="0 0 16 16" aria-hidden="true">
                              <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.977h.004c4.368 0 7.927-3.558 7.93-7.93a7.9 7.9 0 0 0-2.327-5.615zM7.994 14.52a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.69-4.294c-.198-.099-1.17-.578-1.353-.646-.183-.069-.317-.099-.45.1-.132.197-.512.647-.628.78-.117.13-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.117-.198-.011-.304.088-.403.09-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.251-.015-.35-.052-.099-.45-1.08-.616-1.482-.163-.396-.327-.342-.45-.349-.117-.007-.252-.007-.388-.007a.77.77 0 0 0-.559.258c-.185.205-.705.69-.705 1.685s.722 1.956.823 2.093c.1.137 1.42 2.167 3.437 3.033.48.207.854.33 1.147.424.484.153.924.13 1.272.079.388-.058 1.17-.479 1.334-.941.164-.462.164-.859.115-.941-.05-.082-.18-.131-.379-.23"/>
                            </svg>
                            WhatsApp
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
