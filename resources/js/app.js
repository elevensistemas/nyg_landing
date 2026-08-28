import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { initScrollHeader } from './modules/scroll-header';
import { initScrollReveal } from './modules/scroll-reveal';
import { initQuoteFormSteps } from './modules/quote-form-steps';
import { initAjaxForms } from './modules/ajax-forms';
import { initCounters } from './modules/counters';
import { initHeroGlow } from './modules/hero-glow';
import { initClientLogos } from './modules/client-logos';
import { initProcessAnimation } from './modules/process-animation';

document.addEventListener('DOMContentLoaded', () => {
    initScrollHeader();
    initScrollReveal();
    initQuoteFormSteps();
    initAjaxForms();
    initCounters();
    initHeroGlow();
    initClientLogos();
    initProcessAnimation();
});
