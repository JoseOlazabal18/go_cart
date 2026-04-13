<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    if (empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['document_number'])) {
        throw new Exception('Todos los campos obligatorios deben ser completados');
    }

    // Verificar rol Cliente
    $sqlCheckRole = "SELECT id FROM roleperson WHERE description = 'Cliente' LIMIT 1";
    $stmtRole = $conexion->query($sqlCheckRole);
    $roleId = $stmtRole->fetch(PDO::FETCH_COLUMN);

    if (!$roleId) {
        throw new Exception('Error: Rol de Cliente no encontrado');
    }

    // 🔹 Verificar correo existente
    $sqlCheckEmail = "SELECT COUNT(*) FROM cuenta WHERE email = :email";
    $stmtEmail = $conexion->prepare($sqlCheckEmail);
    $stmtEmail->execute([':email' => $_POST['email']]);
    if ($stmtEmail->fetchColumn() > 0) {
        throw new Exception('El correo ya existe en el sistema');
    }

    // 🔹 Verificar username existente
    $sqlCheckUser = "SELECT COUNT(*) FROM cuenta WHERE username = :username";
    $stmtUser = $conexion->prepare($sqlCheckUser);
    $stmtUser->execute([':username' => $_POST['username']]);
    if ($stmtUser->fetchColumn() > 0) {
        throw new Exception('El nombre de usuario ya está en uso, elige otro');
    }

    // 🔹 Verificar documento existente
    $sqlCheckDoc = "SELECT COUNT(*) FROM person WHERE document_number = :document_number";
    $stmtDoc = $conexion->prepare($sqlCheckDoc);
    $stmtDoc->execute([':document_number' => $_POST['document_number']]);
    if ($stmtDoc->fetchColumn() > 0) {
        throw new Exception('El número de documento ya existe en el sistema');
    }

    $conexion->beginTransaction();

    // Insert en person
    $sqlPerson = "INSERT INTO person (name, document_type_id, document_number, address, phone, email, status, role_person_id) 
                  VALUES (:name, :document_type_id, :document_number, :address, :phone, :email, 1, :role_person_id)";
    $stmtPerson = $conexion->prepare($sqlPerson);
    $stmtPerson->execute([
        ':name' => $_POST['name'],
        ':document_type_id' => $_POST['document_type_id'],
        ':document_number' => $_POST['document_number'],
        ':address' => $_POST['address'],
        ':phone' => $_POST['phone'],
        ':email' => $_POST['email'],
        ':role_person_id' => $roleId
    ]);

    $personId = $conexion->lastInsertId();

    // Insert en cuenta
    $sqlCuenta = "INSERT INTO cuenta (id_person, username, password, email) 
                  VALUES (:id_person, :username, :password, :email)";
    $stmtCuenta = $conexion->prepare($sqlCuenta);
    $stmtCuenta->execute([
        ':id_person' => $personId,
        ':username' => $_POST['username'],
        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ':email' => $_POST['email']
    ]);

    $conexion->commit();

    echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
} catch (PDOException $e) {
    if ($conexion->inTransaction()) {
        $conexion->rollBack();
    }

    // Si es error de clave duplicada (23000)
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'Correo, usuario o documento ya registrado en el sistema']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en el registro: ' . $e->getMessage()]);
    }
} catch (Exception $e) {
    if ($conexion->inTransaction()) {
        $conexion->rollBack();
    }
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
