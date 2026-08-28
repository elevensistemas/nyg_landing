export function initClientLogos() {
    const groups = document.querySelectorAll('.logos-fade-group');
    if (groups.length <= 1) return;

    let currentGroupIndex = 0;

    setInterval(() => {
        const activeGroup = groups[currentGroupIndex];
        if (!activeGroup) return;
        activeGroup.classList.remove('active');
        
        setTimeout(() => {
            activeGroup.style.display = 'none';
            
            // Avanzar al siguiente grupo
            currentGroupIndex = (currentGroupIndex + 1) % groups.length;
            
            const nextGroup = groups[currentGroupIndex];
            if (nextGroup) {
                nextGroup.style.display = 'flex';
                
                // Forzar reflow para asegurar animación de entrada
                nextGroup.offsetHeight;
                nextGroup.classList.add('active');
            }
        }, 1000); // Tiempo de la transición CSS
    }, 6000); // Cambiar cada 6 segundos
}
