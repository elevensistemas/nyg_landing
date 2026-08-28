/**
 * Formulario de cotización dividido en pasos. Funciona como progressive
 * enhancement: sin JavaScript, el <form> sigue siendo un formulario normal
 * con todos los campos visibles y envío estándar por POST (el backend nunca
 * depende del JS para funcionar, tal como pide el brief).
 */
export function initQuoteFormSteps() {
    const form = document.querySelector('[data-quote-form]');
    if (!form) return;

    const steps = Array.from(form.querySelectorAll('[data-step]'));
    if (!steps.length) return;

    let current = 0;

    const prevBtn = form.querySelector('[data-step-prev]');
    const nextBtn = form.querySelector('[data-step-next]');
    const submitBtn = form.querySelector('[data-step-submit]');

    const render = () => {
        steps.forEach((step, index) => {
            step.toggleAttribute('data-active', index === current);
        });
        prevBtn.style.visibility = current === 0 ? 'hidden' : 'visible';
        nextBtn.style.display = current === steps.length - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = current === steps.length - 1 ? 'inline-block' : 'none';
    };

    nextBtn?.addEventListener('click', () => {
        const stepFields = steps[current].querySelectorAll('input, select, textarea');
        let valid = true;
        stepFields.forEach((field) => {
            if (!field.checkValidity()) {
                field.reportValidity();
                valid = false;
            }
        });
        if (!valid) return;

        if (current < steps.length - 1) {
            current += 1;
            render();
        }
    });

    prevBtn?.addEventListener('click', () => {
        if (current > 0) {
            current -= 1;
            render();
        }
    });

    render();
}
