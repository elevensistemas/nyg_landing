/**
 * Cambia sutilmente el fondo del header al hacer scroll, según pide el brief
 * ("el header debe comenzar integrado al hero y cambiar sutilmente al hacer scroll").
 */
export function initScrollHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;

    const toggle = () => {
        if (window.scrollY > 40) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
    };

    toggle();
    window.addEventListener('scroll', toggle, { passive: true });
}
