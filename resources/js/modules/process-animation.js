import { gsap } from 'gsap';

export function initProcessAnimation() {
    const desktopSection = document.querySelector('.logistics-process-desktop');
    const mobileSection = document.querySelector('.logistics-process-mobile');
    const targetSection = document.getElementById('ops-view-rendimiento');
    
    if (!targetSection) return;

    // Elementos Desktop
    const glowingDot = document.getElementById('glowing-dot');
    const desktopSteps = document.querySelectorAll('.step-text-block, .process-step-btn');
    const coreIcon = document.querySelector('.core-truck-img');
    
    // Elementos Mobile
    const mobileDot = document.getElementById('mobile-dot');
    const mobileSteps = document.querySelectorAll('.mobile-step-item');

    let desktopTl = null;
    let mobileTl = null;
    let orbitTl = null;
    let breatheTl = null;

    // --- ANIMACIÓN DESKTOP ---
    if (desktopSection && glowingDot) {
        // Inicializar el estado de los ángulos (Comienza en el paso 1, 150 grados)
        const state = { angle: 150 };

        // Definir la trayectoria del punto amarillo
        desktopTl = gsap.timeline({ 
            repeat: -1, 
            paused: true 
        });

        // Configuración de la animación secuencial de ángulos
        desktopTl
            // Inicialización paso 01
            .call(() => setActiveStep(1))
            .to(state, {
                angle: 180,
                duration: 1.5,
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            })
            // Paso 02
            .call(() => setActiveStep(2))
            .to(state, {
                angle: 210,
                duration: 1.5,
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            })
            // Paso 03
            .call(() => setActiveStep(3))
            .to(state, {
                angle: 330,
                duration: 2.2, // Mayor duración para cruzar la parte inferior
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            })
            // Paso 04
            .call(() => setActiveStep(4))
            .to(state, {
                angle: 360,
                duration: 1.5,
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            })
            // Paso 05
            .call(() => setActiveStep(5))
            .to(state, {
                angle: 390,
                duration: 1.5,
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            })
            // Paso 06
            .call(() => setActiveStep(6))
            .to(state, {
                angle: 510, // Retorno al punto inicial (150 grados)
                duration: 2.2, // Mayor duración para cruzar la parte superior
                ease: "power1.inOut",
                onUpdate: () => updateDotPosition(state.angle)
            });

        // 1. Animación inicial (entrada en cascada)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Mostrar punto
                    gsap.set(glowingDot, { opacity: 1 });
                    
                    // Entrada inicial de elementos
                    gsap.fromTo('.process-center-core-new', { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 1, duration: 1, ease: "back.out(1.7)" });
                    gsap.fromTo('.process-orbits-svg-new circle:not(.orbit-glowing-dot-new)', { scale: 0.9, opacity: 0 }, { scale: 1, opacity: 1, duration: 1.2, stagger: 0.15, ease: "power2.out" });
                    
                    // Entrada de los bloques de texto y botones
                    gsap.fromTo('.step-text-block', { opacity: 0 }, { opacity: 0.25, duration: 0.8, stagger: 0.15, delay: 0.5 });
                    gsap.fromTo('.process-step-btn', { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.8, stagger: 0.1, delay: 0.5, ease: "back.out(1.7)" });
                    
                    // Iniciar loops
                    desktopTl.play();
                    orbitTl.play();
                    breatheTl.play();
                } else {
                    desktopTl.pause();
                    orbitTl.pause();
                    breatheTl.pause();
                }
            });
        }, { threshold: 0.2 });

        observer.observe(targetSection);

        // 2. Rotación lenta de las órbitas
        orbitTl = gsap.timeline({ repeat: -1, paused: true });
        orbitTl.to('.orbit-line-new.middle', {
            rotation: 360,
            duration: 50,
            ease: "none"
        });

        // 3. Respiración de la imagen del camión
        breatheTl = gsap.timeline({ repeat: -1, paused: true });
        breatheTl.to(coreIcon, {
            scale: 1.05,
            duration: 2.5,
            ease: "power1.inOut"
        }).to(coreIcon, {
            scale: 1,
            duration: 2.5,
            ease: "power1.inOut"
        });
    }

    // --- ANIMACIÓN MOBILE ---
    if (mobileSection && mobileDot) {
        mobileTl = gsap.timeline({ 
            repeat: -1, 
            paused: true 
        });

        // Animar el punto amarillo verticalmente pasando por las 6 etapas
        mobileTl
            .call(() => setMobileActiveStep(1))
            .to(mobileDot, { top: '5%', duration: 0.5 })
            .to(mobileDot, { top: '23%', duration: 1.2, ease: "power1.inOut" })
            .call(() => setMobileActiveStep(2))
            .to(mobileDot, { top: '41%', duration: 1.2, ease: "power1.inOut" })
            .call(() => setMobileActiveStep(3))
            .to(mobileDot, { top: '59%', duration: 1.2, ease: "power1.inOut" })
            .call(() => setMobileActiveStep(4))
            .to(mobileDot, { top: '77%', duration: 1.2, ease: "power1.inOut" })
            .call(() => setMobileActiveStep(5))
            .to(mobileDot, { top: '95%', duration: 1.2, ease: "power1.inOut" })
            .call(() => setMobileActiveStep(6))
            .to(mobileDot, { top: '95%', duration: 1.5 }) // Pausa en confirmación
            .to(mobileDot, { top: '5%', duration: 1.5, ease: "power2.inOut" }); // Retorno al inicio

        const mobileObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    mobileTl.play();
                } else {
                    mobileTl.pause();
                }
            });
        }, { threshold: 0.1 });

        mobileObserver.observe(targetSection);
    }

    // --- FUNCIONES AUXILIARES ---
    
    // Actualizar posición del punto amarillo en SVG (Desktop)
    function updateDotPosition(angle) {
        if (!glowingDot) return;
        const rad = angle * Math.PI / 180;
        const cx = 250 + 170 * Math.cos(rad);
        const cy = 250 - 170 * Math.sin(rad);
        glowingDot.setAttribute('cx', cx.toString());
        glowingDot.setAttribute('cy', cy.toString());
    }

    // Activar etapa activa en Desktop
    function setActiveStep(stepIndex) {
        desktopSteps.forEach(step => {
            const index = parseInt(step.getAttribute('data-step') || '0');
            if (index === stepIndex) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }

    // Activar etapa activa en Móvil
    function setMobileActiveStep(stepIndex) {
        mobileSteps.forEach(step => {
            const index = parseInt(step.getAttribute('data-step') || '0');
            if (index === stepIndex) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }
}
