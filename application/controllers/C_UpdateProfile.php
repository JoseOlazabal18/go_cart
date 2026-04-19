<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/db_connect.php';

// Aseguramos que la salida será solo JSON
header('Content-Type: application/json; charset=utf-8');
ob_clean();

if (!isset($_SESSION['person_id'])) {
    echo json_encode(["success" => false, "message" => "No autorizado"]);
    exit;
}

try {
    // --- NUEVO BLOQUE ---

    if (isset($_POST['check_password'])) {
        $current = $_POST['current_password'] ?? '';

        $stmt = $conexion->prepare("SELECT password FROM account WHERE id_person = ?");
        $stmt->execute([$_SESSION['person_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($current, $user['password'])) {
            // La contraseña es correcta, damos luz verde al siguiente paso.
            echo json_encode(["success" => true, "message" => "Verificación exitosa."]);
        } else {
            // La contraseña es incorrecta.
            echo json_encode(["success" => false, "message" => "La contraseña actual es incorrecta."]);
        }
        exit;
    }

    // --- BLOQUE MODIFICADO ---

    if (isset($_POST['password_change'])) {
        $new = $_POST['new_password'] ?? '';

        if (empty($new)) {
             echo json_encode(["success" => false, "message" => "La nueva contraseña no puede estar vacía."]);
             exit;
        }

        // Guardar nueva contraseña encriptada.
        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE account SET password = ? WHERE id_person = ?");
        $stmt->execute([$newHash, $_SESSION['person_id']]);

        echo json_encode(["success" => true, "message" => "¡Contraseña actualizada correctamente!"]);
        exit;
    }

    // --- BLOQUE ORIGINAL (SIN CAMBIOS) ---
    // 🔹 Actualización de datos del perfil (nombre, teléfono, etc.).
    $stmt1 = $conexion->prepare("
        UPDATE person 
        SET name = ?, phone = ?, address = ? 
        WHERE id = ?
    ");
    $stmt1->execute([
        $_POST['name'] ?? '',
        $_POST['phone'] ?? '',
        $_POST['address'] ?? '',
        $_SESSION['person_id']
    ]);

    $stmt2 = $conexion->prepare("
        UPDATE account 
        SET username = ? 
        WHERE id_person = ?
    ");
    $stmt2->execute([
        $_POST['username'] ?? '',
        $_SESSION['person_id']
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Tu perfil se ha actualizado correctamente."
    ]);
    exit;

} catch (PDOException $e) {
    // Es una buena práctica capturar excepciones específicas de la base de datos.
    // En un entorno de producción, podrías registrar el error en un archivo en lugar de mostrarlo.
    // error_log($e->getMessage()); 
    echo json_encode([
        "success" => false,
        "message" => "Ocurrió un error en el servidor. Por favor, intente más tarde."
    ]);
    exit;
}
