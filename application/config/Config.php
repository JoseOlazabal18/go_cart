<?php
// Zona Horaria
date_default_timezone_set('America/Lima');

// Protocolo
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}

// URL base del proyecto (IMPORTANTE)
$base_url =  $protocol . $_SERVER['HTTP_HOST'] .  '/go_cart/';

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