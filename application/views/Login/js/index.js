// URL base compartida desde la vista PHP.
const baseUrl = window.APP_CONFIG?.baseUrl || '/';

// Helper visual para centralizar alertas con SweetAlert o alert nativo.
const showMessage = (title, text, icon = 'info') => {
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

// Helper de envio para evitar repetir fetch simple en varios botones.
const submitForm = async (url, formData) => {
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });

    return response.json();
};

const loginForm = document.getElementById('loginForm');
const guestBtn = document.getElementById('guestBtn');

// Envia credenciales al endpoint del controller Auth/login.
loginForm?.addEventListener('submit', async (event) => {
    event.preventDefault();

    const submitButton = loginForm.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    try {
        const data = await submitForm(`${baseUrl}Auth/login`, new FormData(loginForm));
        await showMessage(data.success ? 'Acceso correcto' : 'No se pudo ingresar', data.message, data.success ? 'success' : 'error');

        // Si el backend autentica correctamente, redirigimos.
        if (data.success) {
            window.location.href = data.redirect || baseUrl;
        }
    } catch (error) {
        await showMessage('Error', 'Ocurrio un problema al iniciar sesion.', 'error');
    } finally {
        submitButton.disabled = false;
    }
});

// Flujo de invitado: no requiere formulario, solo crea una sesion minima.
guestBtn?.addEventListener('click', async () => {
    guestBtn.disabled = true;

    try {
        const data = await submitForm(`${baseUrl}Auth/guest`, new FormData());
        await showMessage(data.success ? 'Continuando' : 'No se pudo continuar', data.message, data.success ? 'success' : 'error');

        if (data.success) {
            window.location.href = data.redirect || baseUrl;
        }
    } catch (error) {
        await showMessage('Error', 'Ocurrio un problema al iniciar como invitado.', 'error');
    } finally {
        guestBtn.disabled = false;
    }
});
