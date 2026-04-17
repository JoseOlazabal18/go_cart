// URL base compartida desde PHP.
const registerBaseUrl = window.APP_CONFIG?.baseUrl || '/';

// Helper para mensajes del flujo de registro.
const showRegisterMessage = (title, text, icon = 'info') => {
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

const registerForm = document.getElementById('registerForm');

// Envia el formulario al endpoint Register/store.
registerForm?.addEventListener('submit', async (event) => {
    event.preventDefault();

    const submitButton = registerForm.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    try {
        const response = await fetch(`${registerBaseUrl}Register/store`, {
            method: 'POST',
            body: new FormData(registerForm)
        });

        const data = await response.json();
        await showRegisterMessage(data.success ? 'Registro exitoso' : 'No se pudo registrar', data.message, data.success ? 'success' : 'error');

        // Luego del registro exitoso, el flujo natural es volver al login.
        if (data.success) {
            window.location.href = `${registerBaseUrl}Login`;
        }
    } catch (error) {
        await showRegisterMessage('Error', 'Ocurrio un problema al registrar la cuenta.', 'error');
    } finally {
        submitButton.disabled = false;
    }
});
