/**
 * Inicializa el efecto sutil de resplandor que sigue al mouse en la sección Hero.
 */
export function initHeroGlow() {
    const hero = document.querySelector('.hero-premium');
    if (!hero) return;

    hero.addEventListener('mousemove', (e) => {
        const rect = hero.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        // Asignamos las variables CSS a la sección para que la GPU procese la gradiente
        hero.style.setProperty('--mouse-x', `${x}px`);
        hero.style.setProperty('--mouse-y', `${y}px`);
    }, { passive: true });
}
