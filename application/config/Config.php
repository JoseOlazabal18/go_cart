<?php
// Cargar variables locales si existe un archivo .env en la raiz del proyecto.
if (!function_exists('go_cart_load_env')) {
    // Parser minimo de .env para este proyecto.
    // La idea es poder cambiar credenciales sin tocar el codigo fuente.
    function go_cart_load_env($filePath) {
        if (!is_readable($filePath)) {
            return;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            $parts = explode('=', $trimmed, 2);

            if (count($parts) !== 2) {
                continue;
            }

            $key = trim($parts[0]);
            $value = trim($parts[1]);

            if ($key === '') {
                continue;
            }

            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

go_cart_load_env(ROOT . '.env');

// Zona Horaria
date_default_timezone_set('America/Lima');

// Protocolo
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}

// URL base del proyecto.
// Se arma dinamicamente para que las vistas y fetch usen la misma raiz.
$httpHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
$base_url =  $protocol . $httpHost .  '/go_cart/';

// Constantes globales
define('BASE_URL', $base_url);
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_LAYOUT', 'layout');

// Base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_gliese');
define('DB_PORT', 3306);

// Correo.
// Si estos valores no existen en entorno, el Mailer intentara usar la tabla token.
define('MAIL_HOST', getenv('GO_CART_MAIL_HOST') ?: '');
define('MAIL_PORT', (int) (getenv('GO_CART_MAIL_PORT') ?: 587));
define('MAIL_USERNAME', getenv('GO_CART_MAIL_USERNAME') ?: '');
define('MAIL_PASSWORD', getenv('GO_CART_MAIL_PASSWORD') ?: '');
define('MAIL_ENCRYPTION', getenv('GO_CART_MAIL_ENCRYPTION') ?: 'tls');
define('MAIL_FROM_ADDRESS', getenv('GO_CART_MAIL_FROM') ?: 'no-reply@gocart.local');
define('MAIL_FROM_NAME', getenv('GO_CART_MAIL_FROM_NAME') ?: 'Go Cart');
