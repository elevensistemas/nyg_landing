/**
 * Aparición progresiva al hacer scroll, con IntersectionObserver (liviano,
 * sin dependencias). Respeta prefers-reduced-motion delegando el estado
 * final al CSS (ver resources/css/app.scss).
 */
export function initScrollReveal() {
    const elements = document.querySelectorAll('[data-animate]');
    if (!elements.length) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    elements.forEach((el) => observer.observe(el));
}
