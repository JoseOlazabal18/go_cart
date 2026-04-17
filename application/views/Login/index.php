<!-- Vista de login.
     Aqui solo se renderiza el formulario y los enlaces del flujo auth. -->
<section class="auth-shell login-page">
    <div class="auth-panel auth-panel--card">
        <div class="auth-card">
            <span class="auth-kicker">Login</span>
            <h2>Iniciar sesion</h2>
            <p class="auth-copy">Usa tu usuario registrado para continuar con tu compra.</p>

            <form id="loginForm" class="auth-form">
                <label class="auth-field">
                    <span>Usuario</span>
                    <input type="text" name="username" placeholder="Ingresa tu usuario" autocomplete="username" required>
                </label>

                <label class="auth-field">
                    <span>Contrasena</span>
                    <input type="password" name="password" placeholder="Ingresa tu contrasena" autocomplete="current-password" required>
                </label>

                <button type="submit" class="auth-button">Ingresar</button>
                <button type="button" id="guestBtn" class="auth-button auth-button--ghost">Continuar como invitado</button>
            </form>

            <div class="auth-links">
                <a href="<?php echo BASE_URL; ?>ForgotPassword">Olvide mi contrasena</a>
                <a href="<?php echo BASE_URL; ?>Register">Crear una cuenta</a>
            </div>
        </div>
    </div>
</section>

<script>
// Se expone la URL base al JS para evitar rutas relativas frágiles.
window.APP_CONFIG = {
    baseUrl: '<?php echo BASE_URL; ?>'
};
</script>
<script src="<?php echo BASE_URL; ?>application/views/Login/js/index.js"></script>
