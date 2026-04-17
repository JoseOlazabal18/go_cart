<!-- Vista de recuperacion.
     El flujo se separa en tres formularios para que el usuario vea cada paso. -->
<section class="auth-shell forgot-page">
    <div class="auth-panel auth-panel--card auth-panel--wide">
        <div class="auth-card">
            <span class="auth-kicker">Recuperacion</span>
            <h2>Restablecer contrasena</h2>
            <p class="auth-copy">El proceso se divide en tres pasos: solicitar codigo, validarlo y finalmente registrar la nueva contrasena.</p>

            <div class="recovery-grid">
                <form id="sendCodeForm" class="auth-form recovery-step">
                    <h3>Paso 1</h3>
                    <p>Solicita el codigo con tu correo registrado.</p>
                    <label class="auth-field">
                        <span>Correo</span>
                        <input type="email" name="email" placeholder="correo@dominio.com" autocomplete="email" required>
                    </label>
                    <button type="submit" class="auth-button">Enviar codigo</button>
                </form>

                <form id="verifyCodeForm" class="auth-form recovery-step">
                    <h3>Paso 2</h3>
                    <p>Verifica el codigo recibido por correo.</p>
                    <label class="auth-field">
                        <span>Codigo</span>
                        <input type="text" name="code" placeholder="Ingresa el codigo" inputmode="numeric" required>
                    </label>
                    <button type="submit" class="auth-button auth-button--ghost">Verificar codigo</button>
                </form>

                <form id="resetPasswordForm" class="auth-form recovery-step">
                    <h3>Paso 3</h3>
                    <p>Define una nueva contrasena segura.</p>
                    <label class="auth-field">
                        <span>Nueva contrasena</span>
                        <input type="password" name="password" placeholder="Minimo 8 caracteres" autocomplete="new-password" required>
                    </label>
                    <button type="submit" class="auth-button">Cambiar contrasena</button>
                </form>
            </div>

            <div class="auth-links auth-links--single">
                <a href="<?php echo BASE_URL; ?>Login">Volver al login</a>
            </div>
        </div>
    </div>
</section>

<script>
// URL base compartida con el JS de recuperacion.
window.APP_CONFIG = {
    baseUrl: '<?php echo BASE_URL; ?>'
};
</script>
<script src="<?php echo BASE_URL; ?>application/views/ForgotPassword/js/index.js"></script>
