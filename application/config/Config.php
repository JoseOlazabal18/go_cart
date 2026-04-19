<?php
// Zona Horaria
date_default_timezone_set('America/Lima');

// BASE URL
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', 'http://localhost/go_cart/');
} else {
    define('BASE_URL', 'https://tudominio.com/go_cart/');
}

// Configuración general
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_LAYOUT', 'layout');

// 🔥 BD REMOTA SIEMPRE (SIN LOCAL)
define('DB_HOST', 'solucionesintegralesjb.com');
define('DB_NAME', 'soluciones_gliese');
define('DB_USER', 'soluciones_gliese');
define('DB_PASS', 'Ns7l3TRaF5%!');
define('DB_PORT', 3306);