<?php

$cssFile = __DIR__ . '/../public/build/assets/app-CBO2D5Rc.css';
$extraCss = "\n" . '/* Mobile Responsive Fixes */
@media (max-width: 991.98px) {
    .site-header {
        padding-block: 0.75rem !important;
        background-color: rgba(13, 13, 13, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .site-header .header-logo {
        height: 40px !important;
    }
    .site-header .btn-premium-cta {
        padding: 0.4rem 0.8rem !important;
        font-size: 0.78rem !important;
    }
    .site-header .navbar-collapse {
        position: relative;
        z-index: 1050;
        background-color: rgba(15, 15, 15, 0.98) !important;
        backdrop-filter: blur(25px) !important;
        -webkit-backdrop-filter: blur(25px) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 16px !important;
        padding: 1.25rem 1.5rem !important;
        margin-top: 0.75rem !important;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.9) !important;
    }
    .site-header .navbar-collapse .navbar-nav {
        align-items: flex-start !important;
        gap: 0.25rem !important;
    }
    .site-header .navbar-collapse .navbar-nav .nav-item {
        width: 100%;
    }
    .site-header .navbar-collapse .navbar-nav .nav-item .nav-link {
        display: block;
        padding: 0.6rem 0.5rem !important;
        font-size: 1.05rem !important;
        color: rgba(255, 255, 255, 0.9) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .site-header .navbar-collapse .navbar-nav .nav-item .nav-link:hover {
        color: var(--nyg-yellow-500) !important;
    }
    .site-header .navbar-collapse .navbar-nav .nav-item .btn-whatsapp-header {
        margin-top: 0.75rem;
        display: inline-flex;
        width: 100%;
        justify-content: center;
    }
}
@media (max-width: 767.98px) {
    .hero-content {
        padding-top: 3.5rem !important;
    }
    .hero-title {
        font-size: clamp(1.6rem, 5.5vw, 2.3rem) !important;
        line-height: 1.25 !important;
        margin-bottom: 1rem !important;
    }
    .hero-text {
        font-size: 0.95rem !important;
        line-height: 1.5 !important;
        margin-bottom: 1.5rem !important;
    }
    .hero-buttons {
        flex-direction: column !important;
        width: 100% !important;
        gap: 0.75rem !important;
    }
    .hero-buttons .btn-premium-yellow,
    .hero-buttons .btn-premium-outline {
        width: 100% !important;
        text-align: center !important;
        padding: 0.75rem 1.25rem !important;
    }
    .whatsapp-float {
        bottom: 1.25rem !important;
        right: 1.25rem !important;
        width: 3.25rem !important;
        height: 3.25rem !important;
    }
}
';

file_put_contents($cssFile, $extraCss, FILE_APPEND);
echo "CSS mobile rules appended successfully to " . basename($cssFile) . "\n";
