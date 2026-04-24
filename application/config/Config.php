<?php
// 1. Cargar variables de entorno (Mantenemos tu función de carga)
if (!function_exists('go_cart_load_env')) {
    function go_cart_load_env($filePath) {
        if (!is_readable($filePath)) return;
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || str_starts_with($trimmed, '#')) continue;
            $parts = explode('=', $trimmed, 2);
            if (count($parts) !== 2) continue;
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
}

// Asegúrate de que ROOT esté definido antes o cámbialo por la ruta real
if (!defined('ROOT')) define('ROOT', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
go_cart_load_env(ROOT . '.env');

// 2. Zona Horaria
date_default_timezone_set('America/Lima');

// 3. Configuración de URL BASE (Corregido para evitar duplicados)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$httpHost = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Definimos la base_url solo una vez
if ($httpHost === 'localhost' || str_contains($httpHost, '127.0.0.1')) {
    define('BASE_URL', 'http://localhost/go_cart/');
} else {
    // Aquí puedes usar la lógica dinámica o tu dominio real
    define('BASE_URL', $protocol . $httpHost . '/go_cart/');
}

// 4. Constantes de la Aplicación
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_LAYOUT', 'layout');

// 5. Base de Datos (Asegúrate de que 'db_gliese' existe en tu Laragon)
define('DB_HOST', 'solucionesintegralesjb.com');
define('DB_NAME', 'soluciones_gliese');
define('DB_USER', 'soluciones_gliese');
define('DB_PASS', 'Ns7l3TRaF5%!');
define('DB_PORT', 3306);

// 6. Configuración de Correo (Lo que trajo Quispe)
define('MAIL_HOST', getenv('GO_CART_MAIL_HOST') ?: '');
define('MAIL_PORT', (int) (getenv('GO_CART_MAIL_PORT') ?: 587));
define('MAIL_USERNAME', getenv('GO_CART_MAIL_USERNAME') ?: '');
define('MAIL_PASSWORD', getenv('GO_CART_MAIL_PASSWORD') ?: '');
define('MAIL_ENCRYPTION', getenv('GO_CART_MAIL_ENCRYPTION') ?: 'tls');
define('MAIL_FROM_ADDRESS', getenv('GO_CART_MAIL_FROM') ?: 'no-reply@gocart.local');
define('MAIL_FROM_NAME', getenv('GO_CART_MAIL_FROM_NAME') ?: 'Go Cart');