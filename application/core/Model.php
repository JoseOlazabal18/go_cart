<?php

class Model {

    protected $pdo;

    public function __construct() {

        try {

            $dsn = "mysql:host=" . DB_HOST .
                    ";port=" . DB_PORT .
                    ";dbname=" . DB_NAME .
                    ";charset=utf8";

            $this->pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devuelve arrays asociativos
                    PDO::ATTR_EMULATE_PREPARES => false // Prepared statements reales
                ]
            );

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }

    }

    public function begin_transaction() {
        $this->pdo->beginTransaction();
    }

    public function commit_transaction() {
        if ($this->pdo->inTransaction()) {
            $this->pdo->commit();
        }
    }

    public function rollback_transaction() {
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
    }

    public function get_last_insert_id() {
        return $this->pdo->lastInsertId();
    }

}
