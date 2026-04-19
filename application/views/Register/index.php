<!-- Vista de registro.
     Solo muestra campos de entrada; el procesamiento vive en C_Register. -->
<section class="auth-shell register-page">
    <div class="auth-panel auth-panel--card auth-panel--wide">
        <div class="auth-card">
            <span class="auth-kicker">Registro</span>
            <h2>Crear una cuenta</h2>

            <form id="registerForm" class="auth-form auth-form--grid">
                <label class="auth-field auth-field--full">
                    <span>Nombre completo</span>
                    <input type="text" name="name" placeholder="Ej. Juan Perez" autocomplete="name" required>
                </label>

                <label class="auth-field">
                    <span>Usuario</span>
                    <input type="text" name="username" placeholder="Tu usuario" autocomplete="username" required>
                </label>

                <label class="auth-field">
                    <span>Correo</span>
                    <input type="email" name="email" placeholder="correo@dominio.com" autocomplete="email" required>
                </label>

                <label class="auth-field">
                    <span>Contrasena</span>
                    <input type="password" name="password" placeholder="Minimo 8 caracteres" autocomplete="new-password" required>
                </label>

                <label class="auth-field">
                    <span>Telefono</span>
                    <input type="text" name="phone" placeholder="987654321" autocomplete="tel">
                </label>

                <label class="auth-field">
                    <span>Tipo de documento</span>
                    <select name="document_type_id" required>
                        <option value="">Selecciona un tipo</option>
                        <option value="1">DNI</option>
                        <option value="2">RUC</option>
                    </select>
                </label>

                <label class="auth-field">
                    <span>Numero de documento</span>
                    <input type="text" name="document_number" placeholder="Numero de documento" required>
                </label>

                <label class="auth-field auth-field--full">
                    <span>Direccion</span>
                    <input type="text" name="address" placeholder="Direccion de referencia">
                </label>

                <button type="submit" class="auth-button auth-field--full">Registrarme</button>
            </form>

            <div class="auth-links auth-links--single">
                <a href="<?php echo BASE_URL; ?>Login">Ya tengo una cuenta</a>
            </div>
        </div>
    </div>
</section>

<script>
// Configuracion minima compartida con el JS de esta vista.
window.APP_CONFIG = {
    baseUrl: '<?php echo BASE_URL; ?>'
};
</script>
<script src="<?php echo BASE_URL; ?>application/views/Register/js/index.js"></script>
