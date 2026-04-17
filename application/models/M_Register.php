<?php

// Model de registro.
// Solo contiene consultas SQL relacionadas con validar y crear usuarios cliente.
class M_Register extends Model {

    public function __construct() {
        parent::__construct();
    }

    // Obtiene el rol base para nuevos registros.
    // En esta base el equivalente funcional a USUARIO es Cliente.
    public function find_default_role_id() {
        $sql = 'SELECT id
                FROM roleperson
                WHERE UPPER(description) IN ("USUARIO", "CLIENTE")
                ORDER BY CASE UPPER(description)
                    WHEN "USUARIO" THEN 1
                    WHEN "CLIENTE" THEN 2
                    ELSE 3
                END
                LIMIT 1';

        $statement = $this->pdo->query($sql);

        return $statement->fetchColumn();
    }

    // Validaciones de duplicados para evitar cuentas repetidas.
    public function email_exists($email) {
        $sql = 'SELECT COUNT(*)
                FROM account
                WHERE email = :email';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':email' => $email
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    public function username_exists($username) {
        $sql = 'SELECT COUNT(*)
                FROM account
                WHERE username = :username';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':username' => $username
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    public function document_exists($documentNumber) {
        $sql = 'SELECT COUNT(*)
                FROM person
                WHERE document_number = :document_number';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':document_number' => $documentNumber
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    public function document_type_exists($documentTypeId) {
        $sql = 'SELECT COUNT(*)
                FROM document_type
                WHERE id = :document_type_id
                  AND status = 1';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':document_type_id' => $documentTypeId
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    // Crea el registro de la persona en la tabla principal.
    public function create_person($bind) {
        $sql = 'INSERT INTO person
                    (name, document_type_id, document_number, address, phone, email, status, role_person_id)
                VALUES
                    (:name, :document_type_id, :document_number, :address, :phone, :email, 1, :role_person_id)';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':name' => $bind['name'],
            ':document_type_id' => $bind['document_type_id'],
            ':document_number' => $bind['document_number'],
            ':address' => $bind['address'],
            ':phone' => $bind['phone'],
            ':email' => $bind['email'],
            ':role_person_id' => $bind['role_person_id']
        ]);

        return $this->get_last_insert_id();
    }

    // Crea la cuenta de acceso vinculada a la persona creada.
    public function create_account($bind) {
        $sql = 'INSERT INTO account
                    (id_person, username, password, email, status)
                VALUES
                    (:id_person, :username, :password, :email, 1)';

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ':id_person' => $bind['id_person'],
            ':username' => $bind['username'],
            ':password' => $bind['password'],
            ':email' => $bind['email']
        ]);
    }
}
