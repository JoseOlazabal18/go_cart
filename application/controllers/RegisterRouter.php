<?php

require_once './C_Register.php';

$controller = new C_Register();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'store':
        $controller->store();
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Acción no válida'
        ]);
        break;
}