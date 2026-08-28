/**
 * Mejora progresiva del formulario de contacto: si JS está disponible, envía
 * por fetch y muestra un estado de carga/confirmación sin recargar la
 * página. Si falla o JS está deshabilitado, el <form> hace un submit normal
 * (el backend responde con una redirección y un flash message).
 */
export function initAjaxForms() {
    document.querySelectorAll('[data-ajax-form]').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const statusEl = form.querySelector('[data-form-status]');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalLabel = submitBtn?.textContent;

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';
            }
            if (statusEl) {
                statusEl.textContent = '';
                statusEl.classList.remove('text-danger', 'text-success');
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                if (response.ok) {
                    form.reset();
                    if (statusEl) {
                        statusEl.textContent = 'Gracias por escribirnos. Te vamos a responder a la brevedad.';
                        statusEl.classList.add('text-success');
                    }
                } else {
                    const data = await response.json().catch(() => null);
                    const message = data?.message || 'Revisá los datos del formulario e intentá nuevamente.';
                    if (statusEl) {
                        statusEl.textContent = message;
                        statusEl.classList.add('text-danger');
                    }
                }
            } catch (error) {
                // Si falla el fetch (sin conexión, etc.), se envía el formulario normal como respaldo.
                form.removeAttribute('data-ajax-form');
                form.submit();
                return;
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalLabel;
                }
            }
        });
    });
}
