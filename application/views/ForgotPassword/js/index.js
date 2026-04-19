// URL base enviada desde la vista.
const recoveryBaseUrl = window.APP_CONFIG?.baseUrl || '/';

// Helper de mensajes para los tres pasos de recuperacion.
const showRecoveryMessage = (title, text, icon = 'info') => {
    if (window.Swal) {
        return window.Swal.fire({
            title,
            text,
            icon,
            confirmButtonText: 'Aceptar'
        });
    }

    alert(text);
    return Promise.resolve();
};

// Funcion reutilizable para conectar un formulario con su endpoint.
// Asi mantenemos el mismo patron para pedir codigo, verificar y resetear.
const bindRecoveryForm = (formId, endpoint, successTitle, errorTitle, onSuccess) => {
    const form = document.getElementById(formId);

    form?.addEventListener('submit', async (event) => {
        event.preventDefault();

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        try {
            const response = await fetch(`${recoveryBaseUrl}${endpoint}`, {
                method: 'POST',
                body: new FormData(form)
            });

            const data = await response.json();
            await showRecoveryMessage(data.success ? successTitle : errorTitle, data.message, data.success ? 'success' : 'error');

            if (data.success && typeof onSuccess === 'function') {
                onSuccess(data);
            }
        } catch (error) {
            await showRecoveryMessage('Error', 'Ocurrio un problema al procesar la solicitud.', 'error');
        } finally {
            submitButton.disabled = false;
        }
    });
};

// Paso 1: enviar codigo.
bindRecoveryForm('sendCodeForm', 'Auth/sendRecoveryCode', 'Codigo enviado', 'No se pudo enviar', null);
// Paso 2: verificar codigo.
bindRecoveryForm('verifyCodeForm', 'Auth/verifyRecoveryCode', 'Codigo verificado', 'No se pudo verificar', null);
// Paso 3: guardar nueva contrasena.
bindRecoveryForm('resetPasswordForm', 'Auth/resetPassword', 'Contrasena actualizada', 'No se pudo actualizar', (data) => {
    window.location.href = data.redirect || `${recoveryBaseUrl}Login`;
});
