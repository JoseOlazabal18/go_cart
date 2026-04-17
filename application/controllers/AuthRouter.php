<?php

require_once './C_Auth.php';

$controller = new C_Auth();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'login':
        $controller->login();
        break;

    case 'guest':
        $controller->guest();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'sendRecoveryCode':
        $controller->sendRecoveryCode();
        break;

    case 'verifyRecoveryCode':
        $controller->verifyRecoveryCode();
        break;

    case 'resetPassword':
        $controller->resetPassword();
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Acción no válida'
        ]);
        break;
}