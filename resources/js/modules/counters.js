/**
 * Animación progresiva de contadores numéricos al entrar en pantalla.
 * Utiliza IntersectionObserver y requestAnimationFrame para rendimiento óptimo (60 FPS).
 */
export function initCounters() {
    const counters = document.querySelectorAll('[data-target]');
    if (!counters.length) return;

    const animateCounter = (el) => {
        const target = parseFloat(el.getAttribute('data-target'));
        const decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
        const duration = 2000; // Duración de la animación en ms
        const startTime = performance.now();
        const hasPlus = el.getAttribute('data-plus') === 'true';
        const suffix = el.getAttribute('data-suffix') || '';

        const update = (now) => {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Función de desaceleración (easeOutQuad)
            const easeProgress = progress * (2 - progress);
            const value = easeProgress * target;

            // Formatear valor
            let formattedValue = value.toFixed(decimals);
            
            // Para números grandes, agregar separador de miles
            if (decimals === 0 && target >= 1000) {
                formattedValue = Math.floor(value).toLocaleString('es-AR');
            }

            el.textContent = (hasPlus ? '+' : '') + formattedValue + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                // Asegurar valor exacto al final
                let finalVal = target.toFixed(decimals);
                if (decimals === 0 && target >= 1000) {
                    finalVal = target.toLocaleString('es-AR');
                }
                el.textContent = (hasPlus ? '+' : '') + finalVal + suffix;
            }
        };

        requestAnimationFrame(update);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    counters.forEach((c) => observer.observe(c));
}
