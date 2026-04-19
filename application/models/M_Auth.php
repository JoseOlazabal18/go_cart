<?php

// Model de autenticacion.
// Aqui solo vive logica de acceso a datos:
// buscar usuarios, validar origen de cuenta y actualizar contrasenas.
class M_Auth extends Model {

    public function __construct() {
        parent::__construct();
    }

    // Primero intenta autenticar clientes de e-commerce en account.
    // Si no encuentra, prueba con usuarios internos del sistema en user.
    public function find_user_by_username($username) {
        $accountSql = 'SELECT
                            a.id,
                            a.id_person,
                            a.username,
                            a.password,
                            a.email,
                            a.status,
                            p.name,
                            COALESCE(rp.description, "Cliente") AS role_name,
                            "account" AS source
                        FROM account a
                        INNER JOIN person p ON p.id = a.id_person
                        LEFT JOIN roleperson rp ON rp.id = p.role_person_id
                        WHERE a.username = :username
                        LIMIT 1';

        $statement = $this->pdo->prepare($accountSql);
        $statement->execute([
            ':username' => $username
        ]);

        $account = $statement->fetch();

        if ($account) {
            return $account;
        }

        // user corresponde a usuarios internos del sistema base,
        // por ejemplo administradores u otros perfiles operativos.
        $userSql = 'SELECT
                        u.id,
                        NULL AS id_person,
                        u.user AS username,
                        u.password,
                        u.email,
                        CASE
                            WHEN u.status = 1 AND COALESCE(u.active, 1) = 1 THEN 1
                            ELSE 0
                        END AS status,
                        TRIM(CONCAT(u.first_name, " ", u.last_name)) AS name,
                        COALESCE(r.description, "USUARIO") AS role_name,
                        "user" AS source
                    FROM user u
                    LEFT JOIN role r ON r.id = u.id_role
                    WHERE u.user = :username
                    LIMIT 1';

        $statement = $this->pdo->prepare($userSql);
        $statement->execute([
            ':username' => $username
        ]);

        return $statement->fetch();
    }

    // Recuperacion por correo:
    // se hace la misma busqueda en account y luego en user.
    public function find_user_by_email($email) {
        $accountSql = 'SELECT
                            a.id,
                            a.id_person,
                            a.username,
                            a.email,
                            p.name,
                            "account" AS source
                        FROM account a
                        INNER JOIN person p ON p.id = a.id_person
                        WHERE a.email = :email
                        LIMIT 1';

        $statement = $this->pdo->prepare($accountSql);
        $statement->execute([
            ':email' => $email
        ]);

        $account = $statement->fetch();

        if ($account) {
            return $account;
        }

        $userSql = 'SELECT
                        u.id,
                        NULL AS id_person,
                        u.user AS username,
                        u.email,
                        TRIM(CONCAT(u.first_name, " ", u.last_name)) AS name,
                        "user" AS source
                    FROM user u
                    WHERE u.email = :email
                    LIMIT 1';

        $statement = $this->pdo->prepare($userSql);
        $statement->execute([
            ':email' => $email
        ]);

        return $statement->fetch();
    }

    // Actualiza la contrasena segun la fuente del usuario.
    // account y user no usan necesariamente el mismo formato.
    public function update_password_by_email($bind) {
        $table = ($bind['source'] ?? 'account') === 'user' ? 'user' : 'account';
        $sql = 'UPDATE ' . $table . '
                SET password = :password
                WHERE email = :email';

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ':password' => $bind['password'],
            ':email' => $bind['email']
        ]);
    }

    // Verifica contrasena segun el origen:
    // - account usa password_hash/password_verify
    // - user usa formato legado de la base original
    public function verify_password($plainPassword, $storedPassword, $source) {
        if ($source === 'user') {
            return $storedPassword === $this->encode_legacy_user_password($plainPassword)
                || $storedPassword === md5($plainPassword);
        }

        return password_verify($plainPassword, $storedPassword);
    }

    // Genera el hash correcto para la tabla de destino.
    public function hash_password_for_source($plainPassword, $source) {
        if ($source === 'user') {
            return $this->encode_legacy_user_password($plainPassword);
        }

        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    // Compatibilidad con el formato antiguo hallado en la tabla user.
    private function encode_legacy_user_password($plainPassword) {
        return bin2hex(base64_encode(md5($plainPassword)));
    }
}
