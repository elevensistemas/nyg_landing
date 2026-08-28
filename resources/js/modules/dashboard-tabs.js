export function initDashboardTabs() {
    const tabs = document.querySelectorAll('[data-tab]');
    const viewVisionGeneral = document.getElementById('ops-view-vision-general');
    const viewRutasEnCurso = document.getElementById('ops-view-rutas-en-curso');
    const viewRendimiento = document.getElementById('ops-view-rendimiento');
    const sidebarFilters = document.getElementById('ops-sidebar-filters');
    const clockRutas = document.getElementById('ops-clock-rutas');
    const prevBtn = document.querySelector('.nav-arrow-btn[aria-label="Anterior"]');
    const nextBtn = document.querySelector('.nav-arrow-btn[aria-label="Siguiente"]');

    if (!tabs.length) return;

    let autoRotateInterval = null;
    const intervalDuration = 8000; // 8 segundos
    const tabNames = ['vision-general', 'rutas-en-curso', 'rendimiento'];
    let currentTabIndex = 0;
    let isPaused = false;

    function activateTab(targetTab) {
        currentTabIndex = tabNames.indexOf(targetTab);

        // Actualizar todos los tabs con el atributo data-tab coincidente
        tabs.forEach(t => {
            if (t.getAttribute('data-tab') === targetTab) {
                t.classList.add('active');
                // Asegurar indicador activo de escritorio
                if (!t.querySelector('.active-indicator') && t.classList.contains('sidebar-item')) {
                    const indicator = document.createElement('div');
                    indicator.className = 'active-indicator';
                    t.appendChild(indicator);
                }
            } else {
                t.classList.remove('active');
                const indicator = t.querySelector('.active-indicator');
                if (indicator) indicator.remove();
            }
        });

        // Alternar vistas
        if (viewVisionGeneral) viewVisionGeneral.style.display = targetTab === 'vision-general' ? 'block' : 'none';
        if (viewRutasEnCurso) viewRutasEnCurso.style.display = targetTab === 'rutas-en-curso' ? 'block' : 'none';
        if (viewRendimiento) viewRendimiento.style.display = targetTab === 'rendimiento' ? 'block' : 'none';

        // Mostrar filtros rápidos solo en Rutas en Curso
        if (sidebarFilters) {
            sidebarFilters.style.display = targetTab === 'rutas-en-curso' ? 'block' : 'none';
        }
    }

    function nextTab() {
        if (isPaused) return;
        currentTabIndex = (currentTabIndex + 1) % tabNames.length;
        activateTab(tabNames[currentTabIndex]);
    }

    function startAutoRotation() {
        stopAutoRotation();
        autoRotateInterval = setInterval(nextTab, intervalDuration);
    }

    function stopAutoRotation() {
        if (autoRotateInterval) {
            clearInterval(autoRotateInterval);
            autoRotateInterval = null;
        }
    }

    // Configurar eventos click para los tabs
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetTab = tab.getAttribute('data-tab');
            activateTab(targetTab);
            // Reiniciar timer en acción manual
            startAutoRotation();
        });
    });

    // Flechas anterior y siguiente
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentTabIndex = (currentTabIndex - 1 + tabNames.length) % tabNames.length;
            activateTab(currentTabIndex >= 0 ? tabNames[currentTabIndex] : tabNames[0]);
            startAutoRotation();
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentTabIndex = (currentTabIndex + 1) % tabNames.length;
            activateTab(tabNames[currentTabIndex]);
            startAutoRotation();
        });
    }

    // Pausar rotación en hover (sección operaciones)
    const operationsSection = document.getElementById('operaciones');
    if (operationsSection) {
        operationsSection.addEventListener('mouseenter', () => {
            isPaused = true;
        });
        operationsSection.addEventListener('mouseleave', () => {
            isPaused = false;
        });
    }

    // Inicializar
    activateTab('vision-general');
    startAutoRotation();

    // Enlace "Ver mapa" desde Visión General
    const viewMapLink = document.getElementById('btn-ops-view-map-link');
    if (viewMapLink) {
        viewMapLink.addEventListener('click', (e) => {
            e.preventDefault();
            activateTab('rutas-en-curso');
            startAutoRotation();
        });
    }

    // Sincronizar reloj de la vista de Rutas
    if (clockRutas) {
        const updateRutasClock = () => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clockRutas.textContent = `${hours}:${minutes}:${seconds}`;
        };
        updateRutasClock();
        setInterval(updateRutasClock, 1000);
    }
}
