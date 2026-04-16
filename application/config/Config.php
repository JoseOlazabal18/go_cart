<?php
// Zona Horaria
date_default_timezone_set('America/Lima');

// ENTORNO (simple y controlado)
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', 'http://localhost/go_cart/');
} else {
    define('BASE_URL', 'https://tudominio.com/go_cart/');
}

// Configuración general
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_LAYOUT', 'layout');

// Base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_gliese');
define('DB_PORT', 3306);