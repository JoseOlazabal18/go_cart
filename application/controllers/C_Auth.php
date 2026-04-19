<?php

require_once APP_PATH . 'Utils' . DS . 'Mailer.php';

// Controller de autenticacion.
// Aqui se recibe la informacion del formulario, se valida el flujo
// y se delega toda consulta o actualizacion al model.
class C_Auth extends Controller {

    private $authModel;

    public function __construct() {
        parent::__construct();
        $this->authModel = $this->load_model('Auth');
    }

    // Redireccion de seguridad: si alguien entra a /Auth sin metodo,
    // lo enviamos a la pantalla de login.
    public function index() {
        header('Location: ' . BASE_URL . 'Login');
        exit;
    }

    // Login clasico con usuario + contrasena.
    // El controller valida entrada, pide el usuario al model y crea la sesion.
    public function login() {
        try {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                throw new Exception('Usuario y contrasena son obligatorios.');
            }

            $user = $this->authModel->find_user_by_username($username);

            if (!$user) {
                throw new Exception('Usuario no encontrado.');
            }

            if ((int) $user['status'] !== 1) {
                throw new Exception('La cuenta se encuentra inactiva.');
            }

            if (!$this->authModel->verify_password($password, $user['password'], $user['source'])) {
                throw new Exception('Contrasena incorrecta.');
            }

            // Esta sesion sera la referencia para saber
            // quien esta autenticado y con que rol entro.
            $_SESSION['auth'] = [
                'id' => (int) $user['id'],
                'person_id' => (int) $user['id_person'],
                'username' => $user['username'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $this->normalize_role($user['role_name']),
                'role_label' => $user['role_name'],
                'source' => $user['source'],
                'is_guest' => false
            ];

            Response::json([
                'success' => true,
                'message' => 'Inicio de sesion exitoso.',
                'role' => $_SESSION['auth']['role'],
                'redirect' => BASE_URL
            ]);
        } catch (Exception $e) {
            Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Flujo rapido para navegar como invitado.
    // No consulta base de datos, solo crea una sesion minima.
    public function guest() {
        $_SESSION['auth'] = [
            'id' => null,
            'person_id' => null,
            'username' => 'guest',
            'name' => 'Invitado',
            'email' => null,
            'role' => 'INVITADO',
            'role_label' => 'Invitado',
            'source' => 'guest',
            'is_guest' => true
        ];

        Response::json([
            'success' => true,
            'message' => 'Sesion iniciada como invitado.',
            'redirect' => BASE_URL
        ]);
    }

    // Cierre completo de sesion: limpia datos en memoria,
    // elimina cookie y destruye la sesion activa.
    public function logout() {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        Response::json([
            'success' => true,
            'message' => 'Sesion cerrada correctamente.'
        ]);
    }

    // Paso 1 de recuperacion:
    // verifica que el correo exista, genera un codigo temporal
    // y lo guarda en sesion para los siguientes pasos.
    public function sendRecoveryCode() {
        try {
            $email = trim($_POST['email'] ?? '');

            if ($email === '') {
                throw new Exception('El correo es obligatorio.');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Ingresa un correo valido.');
            }

            $user = $this->authModel->find_user_by_email($email);

            if (!$user) {
                throw new Exception('No existe una cuenta asociada a este correo.');
            }

            $code = (string) random_int(100000, 999999);

            // recovery vive en sesion porque el proceso es corto:
            // pedir codigo -> verificar -> cambiar contrasena.
            $_SESSION['recovery'] = [
                'email' => $email,
                'code' => $code,
                'source' => $user['source'],
                'verified' => false,
                'expires_at' => time() + (15 * 60)
            ];

            Mailer::send_recovery_mail($email, $user['name'], $code);

            Response::json([
                'success' => true,
                'message' => 'Se envio el codigo de recuperacion al correo registrado.'
            ]);
        } catch (Exception $e) {
            Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Paso 2 de recuperacion:
    // valida que el codigo coincida con el guardado en sesion.
    public function verifyRecoveryCode() {
        try {
            $code = trim($_POST['code'] ?? '');

            if ($code === '') {
                throw new Exception('El codigo es obligatorio.');
            }

            $recovery = $_SESSION['recovery'] ?? null;

            if (!$recovery) {
                throw new Exception('No existe una solicitud de recuperacion activa.');
            }

            if (($recovery['expires_at'] ?? 0) < time()) {
                unset($_SESSION['recovery']);
                throw new Exception('El codigo expiro. Solicita uno nuevo.');
            }

            if ($recovery['code'] !== $code) {
                throw new Exception('Codigo incorrecto.');
            }

            // verified habilita el paso final de cambio de contrasena.
            $_SESSION['recovery']['verified'] = true;

            Response::json([
                'success' => true,
                'message' => 'Codigo verificado correctamente.'
            ]);
        } catch (Exception $e) {
            Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Paso 3 de recuperacion:
    // actualiza la contrasena en la tabla correcta y cierra el flujo.
    public function resetPassword() {
        try {
            $newPassword = $_POST['password'] ?? '';

            if ($newPassword === '') {
                throw new Exception('La nueva contrasena es obligatoria.');
            }

            if (strlen($newPassword) < 8) {
                throw new Exception('La nueva contrasena debe tener al menos 8 caracteres.');
            }

            $recovery = $_SESSION['recovery'] ?? null;

            if (!$recovery) {
                throw new Exception('No existe una solicitud de recuperacion activa.');
            }

            if (($recovery['verified'] ?? false) !== true) {
                throw new Exception('Primero debes verificar el codigo de recuperacion.');
            }

            $updated = $this->authModel->update_password_by_email([
                'email' => $recovery['email'],
                'password' => $this->authModel->hash_password_for_source(
                    $newPassword,
                    $recovery['source'] ?? 'account'
                ),
                'source' => $recovery['source'] ?? 'account'
            ]);

            if (!$updated) {
                throw new Exception('No se pudo actualizar la contrasena.');
            }

            unset($_SESSION['recovery']);

            Response::json([
                'success' => true,
                'message' => 'Contrasena actualizada correctamente.',
                'redirect' => BASE_URL . 'Login'
            ]);
        } catch (Exception $e) {
            Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Normaliza los nombres de rol de la base a los roles funcionales
    // que se pidieron para el proyecto.
    private function normalize_role($role) {
        $normalized = strtoupper(trim((string) $role));

        if ($normalized === 'ADMINISTRADOR' || $normalized === 'ADMIN') {
            return 'ADMIN';
        }

        if (
            str_contains($normalized, 'SOPORTE') ||
            str_contains($normalized, 'SEGURIDAD') ||
            str_contains($normalized, 'TECNICO')
        ) {
            return 'SOPORTE';
        }

        if (str_contains($normalized, 'VENTA') || $normalized === 'VENDEDOR') {
            return 'VENDEDOR';
        }

        if (
            $normalized === 'CLIENTE' ||
            $normalized === 'USUARIO' ||
            $normalized === 'PRUEBA'
        ) {
            return 'USUARIO';
        }

        return $normalized === '' ? 'USUARIO' : $normalized;
    }
}
